<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\WalletType;
use App\Models\QPhoneOrder;
use App\Services\TransactionService;
use App\Mail\QPhoneSubmitted;
use App\Mail\QPhoneApproved;
use App\Mail\QPhoneRejected;
use Illuminate\Support\Facades\DB;

class QPhoneController extends Controller
{
    // User: show order page (first step)
    public function order()
    {
        $title = 'Order Qphone';
        return view('user.pages.qphone-order', compact('title'));
    }

    // User: show product and payment UI
    public function show()
    {
        $title = 'QPhone';
        $activeWalletTypes = WalletType::where('active', true)->get();
        // Static product sample (image stored in public/images/qphone.png). Admin can update later.
        $product = [
            'name' => 'Ledger Stax™',
            'image' => 'images/qphone.png',
            'price' => 639.00,
            'currency' => 'USD',
        ];
        $latestOrder = QPhoneOrder::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->first();
        return view('user.pages.qphone', compact('title','activeWalletTypes','product','latestOrder'));
    }

    // User: place order (mark as paid pending verification)
    public function store(Request $request)
    {
        $request->validate([
            'payment_coin' => 'required|exists:wallet_type,short_code',
            'wallet_address' => 'nullable|string|max:255',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
            'tx_reference' => 'nullable|string|max:255',
            'quantity' => 'required|integer|min:1',
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')->store('payment_proofs', 'public');
        }

        DB::beginTransaction();
        try {
            $order = QPhoneOrder::create([
                'user_id' => Auth::id(),
                'product_name' => $request->product_name,
                'product_image' => $request->product_image,
                'price' => $request->price,
                'quantity' => $request->quantity,
                'payment_coin' => $request->payment_coin,
                'wallet_address' => $request->wallet_address,
                'payment_proof' => $proofPath,
                'tx_reference' => $request->tx_reference,
                'status' => 'pending',
                'paid_at' => null,
            ]);

            // Create transaction record for QPhone order
            $metadata = [
                'product_name' => $request->product_name,
                'product_image' => $request->product_image ?? null,
                'quantity' => $request->quantity,
                'payment_coin' => $request->payment_coin,
                'wallet_address' => $request->wallet_address,
                'payment_proof' => $proofPath,
                'tx_reference' => $request->tx_reference,
                'qphone_order_id' => $order->id
            ];

            TransactionService::createTransaction([
                'user_id' => Auth::id(),
                'username' => Auth::user()->username,
                'transaction_type' => \App\Models\Transactions::TYPE_CARD_PURCHASE,
                'reference_id' => $order->id,
                'reference_type' => QPhoneOrder::class,
                'amount' => $request->price * $request->quantity,
                'description' => "QPhone Order: {$request->product_name} x {$request->quantity}",
                'currency' => 'USD',
                'payment_method' => \App\Models\Transactions::PAYMENT_CRYPTO,
                'payment_status' => \App\Models\Transactions::PAYMENT_PENDING,
                'status' => \App\Models\Transactions::STATUS_PENDING,
                'metadata' => $metadata
            ]);

            DB::commit();

            try {
                Mail::to(Auth::user()->email)->send(new QPhoneSubmitted($order));
            } catch (\Exception $e) {
                report($e);
            }

            Alert::success('Success', 'Payment submitted. You will be notified after verification.');
            return redirect()->route('user.qphone.show');

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Failed to submit order. Please try again.');
            return redirect()->back();
        }
    }

    // Admin: list orders
    public function adminIndex()
    {
        $title = 'QPhone Payments';
        $orders = QPhoneOrder::with('user')->orderBy('created_at','desc')->paginate(20);
        return view('admin.pages.qphone-orders', compact('title','orders'));
    }

    // Admin: preview single
    public function adminPreview($id)
    {
        $title = 'Preview QPhone Payment';
        $order = QPhoneOrder::with('user')->findOrFail($id);
        return view('admin.pages.preview-qphone-order', compact('title','order'));
    }

    // Admin: approve
    public function approve(Request $request, $id)
    {
        $request->validate(['admin_notes' => 'nullable|string|max:500']);

        DB::beginTransaction();
        try {
            $order = QPhoneOrder::findOrFail($id);
            $order->status = 'approved';
            $order->admin_notes = $request->admin_notes;
            $order->approved_at = now();
            $order->save();

            // Find and update the related transaction
            $transaction = \App\Models\Transactions::where('reference_id', $order->id)
                ->where('reference_type', QPhoneOrder::class)
                ->first();

            if ($transaction) {
                TransactionService::approveTransaction($transaction, $request->admin_notes);
            }

            DB::commit();

            try {
                Mail::to($order->user->email)->send(new QPhoneApproved($order));
            } catch (\Exception $e) {}

            Alert::success('Success', 'Payment approved.');
            return back();

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Failed to approve payment: ' . $e->getMessage());
            return back();
        }
    }

    // Admin: reject
    public function reject(Request $request, $id)
    {
        $request->validate(['admin_notes' => 'required|string|max:500']);

        DB::beginTransaction();
        try {
            $order = QPhoneOrder::findOrFail($id);
            $order->status = 'rejected';
            $order->admin_notes = $request->admin_notes;
            $order->rejected_at = now();
            $order->save();

            // Find and update the related transaction
            $transaction = \App\Models\Transactions::where('reference_id', $order->id)
                ->where('reference_type', QPhoneOrder::class)
                ->first();

            if ($transaction) {
                TransactionService::rejectTransaction($transaction, $request->admin_notes);
            }

            DB::commit();

            try {
                Mail::to($order->user->email)->send(new QPhoneRejected($order));
            } catch (\Exception $e) {}

            Alert::success('Success', 'Payment rejected.');
            return back();

        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Error', 'Failed to reject payment: ' . $e->getMessage());
            return back();
        }
    }
}
