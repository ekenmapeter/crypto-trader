<?php

namespace App\Http\Controllers;

use App\Models\Verification;
use App\Models\VerificationDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class KycController extends Controller
{
    public function create()
    {
        $verification = Verification::where('user_id', Auth::id())
            ->latest()->first();
        return view('user.pages.verify', [
            'title' => 'Verify Account',
            'verification' => $verification,
            'setting' => \App\Models\AdminSetting::first(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'country' => 'required|string|size:2',
            'document_type' => 'required|string',
            'ssn_last4' => 'nullable|digits:4',
            'doc_front' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'doc_back' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'selfie' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
        ]);

        $verification = Verification::create([
            'user_id' => Auth::id(),
            'country' => strtoupper($request->country),
            'document_type' => $request->document_type,
            'ssn_last4' => $request->ssn_last4,
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        if ($request->hasFile('doc_front')) {
            $path = $request->file('doc_front')->store('kyc', 'public');
            VerificationDocument::create([
                'verification_id' => $verification->id,
                'type' => 'front',
                'path' => $path,
            ]);
        }
        if ($request->hasFile('doc_back')) {
            $path = $request->file('doc_back')->store('kyc', 'public');
            VerificationDocument::create([
                'verification_id' => $verification->id,
                'type' => 'back',
                'path' => $path,
            ]);
        }
        if ($request->hasFile('selfie')) {
            $path = $request->file('selfie')->store('kyc', 'public');
            VerificationDocument::create([
                'verification_id' => $verification->id,
                'type' => 'selfie',
                'path' => $path,
            ]);
        }

        // Send email notification to admin
        try {
            Mail::to('admin@example.com')->send(new \App\Mail\KycSubmitted(Auth::user(), $verification));
        } catch (\Exception $e) {
            // Log error if email fails
            Log::error('Failed to send KYC submission email: ' . $e->getMessage());
        }

        return redirect()->route('user.verify.create')->with('success', 'Verification submitted.');
    }

    // Admin
    public function adminIndex()
    {
        $verifications = Verification::latest()->paginate(20);
        return view('admin.pages.kyc-list', compact('verifications'));
    }

    public function adminShow($id)
    {
        $verification = Verification::with('user', 'documents')->findOrFail($id);
        return view('admin.pages.kyc-preview', compact('verification'));
    }

    public function adminApprove($id, Request $request)
    {
        $verification = Verification::findOrFail($id);
        $verification->status = 'approved';
        $verification->admin_notes = $request->input('admin_notes');
        $verification->reviewed_at = now();
        $verification->save();

        // Send email notification to user
        try {
            Mail::to($verification->user->email)->send(new \App\Mail\KycApproved($verification->user, $verification));
        } catch (\Exception $e) {
            // Log error if email fails
            Log::error('Failed to send KYC approval email: ' . $e->getMessage());
        }

        return back()->with('success', 'KYC approved');
    }

    public function adminReject($id, Request $request)
    {
        $verification = Verification::findOrFail($id);
        $verification->status = 'rejected';
        $verification->admin_notes = $request->input('admin_notes');
        $verification->reviewed_at = now();
        $verification->save();

        // Send email notification to user
        try {
            Mail::to($verification->user->email)->send(new \App\Mail\KycRejected($verification->user, $verification));
        } catch (\Exception $e) {
            // Log error if email fails
            Log::error('Failed to send KYC rejection email: ' . $e->getMessage());
        }

        return back()->with('success', 'KYC rejected');
    }

        /**
     * Check verification status for AJAX request
     */
    public function checkVerificationStatus()
    {
        $user = Auth::user();
        $verification = Verification::where('user_id', $user->id)
            ->latest()
            ->first();

        $isVerified = !empty($verification) && $verification->status === 'approved';

        return response()->json([
            'isVerified' => $isVerified,
            'status' => $verification ? $verification->status : 'none',
            'message' => $isVerified ? 'Account verified' : 'Account pending verification',
            'verification' => $verification
        ]);
    }
}


