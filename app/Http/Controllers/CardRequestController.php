<?php

namespace App\Http\Controllers;

use App\Models\CardRequest;
use App\Models\UserWallet;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\CardRequestSubmitted;
use App\Mail\CardRequestApproved;
use App\Mail\CardRequestRejected;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\WalletType;
use Illuminate\Support\Facades\DB;

class CardRequestController extends Controller
{
    /**
     * Display the card request form
     */
    public function create()
    {
        $title = 'Card Request';
        $user = Auth::user();

        // Get all active wallet types for card type selection
        $activeWalletTypes = WalletType::where('active', true)->get();

        $setting = \App\Models\AdminSetting::first();
        return view('user.pages.card-request', compact('title', 'user', 'activeWalletTypes', 'setting'));
    }

    /**
     * Store a new card request
     */
    public function store(Request $request)
    {
        $request->validate([
            'card_type' => 'required|in:Visa Card,Master Card,Premium card',
            'payment_coin' => 'required|exists:wallet_type,short_code',
            'cardholder_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'proof_of_address' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        $filePath = null;
        if ($request->hasFile('proof_of_address')) {
            $file = $request->file('proof_of_address');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('proof_of_address', $fileName, 'public');
        }

        // Determine payment details from selected payment coin
        $paymentWalletType = WalletType::where('short_code', $request->payment_coin)->first();

        DB::beginTransaction();
        try {
            // Create card request
            $cardRequest = CardRequest::create([
                'user_id' => Auth::id(),
                'card_type' => $request->card_type,
                'cardholder_name' => $request->cardholder_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'proof_of_address_file' => $filePath,
                'wallet_address' => $paymentWalletType->payment_wallet_address ?? null,
                'status' => 'pending',
            ]);

            // Create transaction record for card request
            $metadata = [
                'card_type' => $request->card_type,
                'payment_coin' => $request->payment_coin,
                'cardholder_name' => $request->cardholder_name,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'proof_of_address_file' => $filePath,
                'wallet_address' => $paymentWalletType->payment_wallet_address,
                'card_request_id' => $cardRequest->id
            ];

            TransactionService::createCardPurchaseTransaction(
                Auth::user(),
                0, // No amount charged yet, will be set on approval
                $request->card_type,
                $metadata
            );

            DB::commit();

            try {
                Mail::to($request->email)->send(new CardRequestSubmitted($cardRequest));
            } catch (\Exception $e) {
                // Log email error but don't fail the request
            }

            Alert::success('Success', 'Your card request has been submitted successfully!');
            return redirect()->route('user.card-requests');

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Failed to submit card request. Please try again.');
            return redirect()->back();
        }
    }

    /**
     * Display user's card requests
     */
    public function index()
    {
        $title = 'My Card Requests';
        $cardRequests = CardRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.pages.my-card-requests', compact('title', 'cardRequests'));
    }

    /**
     * Display a specific card request
     */
    public function show($id)
    {
        $cardRequest = CardRequest::where('user_id', Auth::id())->findOrFail($id);
        $title = 'Card Request Details';

        return view('user.pages.card-request-details', compact('title', 'cardRequest'));
    }

    /**
     * Admin: Display all card requests
     */
    public function adminIndex()
    {
        $title = 'All Card Requests';
        $cardRequests = CardRequest::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.pages.card-requests', compact('title', 'cardRequests'));
    }

    /**
     * Admin: Display pending card requests
     */
    public function adminPending()
    {
        $title = 'Pending Card Requests';
        $cardRequests = CardRequest::with('user')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->paginate(15);

        return view('admin.pages.card-requests', compact('title', 'cardRequests'));
    }

    /**
     * Admin: Preview card request
     */
    public function adminPreview($id)
    {
        $cardRequest = CardRequest::with('user')->findOrFail($id);
        $title = 'Preview Card Request';

        return view('admin.pages.preview-card-request', compact('title', 'cardRequest'));
    }

    /**
     * Admin: Approve card request
     */
    public function adminApprove(Request $request, $id)
    {
        $cardRequest = CardRequest::findOrFail($id);

        $request->validate([
            'admin_notes' => 'nullable|string|max:500',
            'card_amount' => 'required|numeric|min:0.01',
            'card_number' => 'nullable|string|max:19',
            'expiry' => 'nullable|string|max:5',
            'cvv' => 'nullable|string|max:4',
        ]);

        DB::beginTransaction();
        try {
            // Approve the card request
            $cardRequest->approve($request->admin_notes);

            // Update card details if provided
            if ($request->card_number) {
                $cardRequest->update([
                    'card_number' => $request->card_number,
                    'expiry' => $request->expiry,
                    'cvv' => $request->cvv,
                ]);
            }

            // Find and update the related transaction
            $transaction = \App\Models\Transactions::where('reference_id', $cardRequest->id)
                ->where('reference_type', CardRequest::class)
                ->first();

            if ($transaction) {
                // Update transaction with card amount and approve it
                $transaction->update([
                    'amount' => $request->card_amount,
                    'description' => "Card purchase: {$cardRequest->card_type} - {$request->card_amount} USD",
                    'admin_notes' => $request->admin_notes
                ]);

                TransactionService::approveTransaction($transaction, $request->admin_notes);
            }

            DB::commit();

            // Send approval email
            try {
                Mail::to($cardRequest->email)->send(new CardRequestApproved($cardRequest));
            } catch (\Exception $e) {
                // Log email error but don't fail the approval
            }

            Alert::success('Success', 'Card request has been approved successfully!');
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Failed to approve card request: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Admin: Reject card request
     */
    public function adminReject(Request $request, $id)
    {
        $cardRequest = CardRequest::findOrFail($id);

        $request->validate([
            'admin_notes' => 'required|string|max:500',
        ]);

        DB::beginTransaction();
        try {
            // Reject the card request
            $cardRequest->reject($request->admin_notes);

            // Find and update the related transaction
            $transaction = \App\Models\Transactions::where('reference_id', $cardRequest->id)
                ->where('reference_type', CardRequest::class)
                ->first();

            if ($transaction) {
                TransactionService::rejectTransaction($transaction, $request->admin_notes);
            }

            DB::commit();

            // Send rejection email
            try {
                Mail::to($cardRequest->email)->send(new CardRequestRejected($cardRequest));
            } catch (\Exception $e) {
                // Log email error but don't fail the rejection
            }

            Alert::success('Success', 'Card request has been rejected.');
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Failed to reject card request: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
