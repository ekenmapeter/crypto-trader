<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTransactionController extends Controller
{
    /**
     * Display a listing of all transactions
     */
    public function index(Request $request)
    {
        $title = 'All Transactions';

        $query = $request->get('query');
        $filters = [
            'status' => $request->get('status'),
            'transaction_type' => $request->get('transaction_type'),
            'payment_method' => $request->get('payment_method'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];

        $transactions = TransactionService::searchTransactions($query, $filters, 20);
        $statistics = TransactionService::getTransactionStatistics();
        $statisticsByType = TransactionService::getTransactionStatisticsByType();

        return view('admin.pages.transactions.index', compact(
            'title',
            'transactions',
            'statistics',
            'statisticsByType',
            'filters'
        ));
    }

    /**
     * Display pending transactions
     */
    public function pending()
    {
        $title = 'Pending Transactions';
        $transactions = TransactionService::getPendingTransactions(20);
        $statistics = TransactionService::getTransactionStatistics();

        return view('admin.pages.transactions.pending', compact(
            'title',
            'transactions',
            'statistics'
        ));
    }

    /**
     * Display completed transactions
     */
    public function completed()
    {
        $title = 'Completed Transactions';
        $transactions = TransactionService::getTransactionsByType('completed', 20);
        $statistics = TransactionService::getTransactionStatistics();

        return view('admin.pages.transactions.completed', compact(
            'title',
            'transactions',
            'statistics'
        ));
    }

    /**
     * Display failed transactions
     */
    public function failed()
    {
        $title = 'Failed Transactions';
        $transactions = TransactionService::getTransactionsByType('failed', 20);
        $statistics = TransactionService::getTransactionStatistics();

        return view('admin.pages.transactions.failed', compact(
            'title',
            'transactions',
            'statistics'
        ));
    }

    /**
     * Display a specific transaction
     */
    public function show($id)
    {
        $transaction = Transactions::with('user', 'reference')->findOrFail($id);
        $title = 'Transaction Details';

        return view('admin.pages.transactions.show', compact('title', 'transaction'));
    }

    /**
     * Approve a transaction
     */
    public function approve(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:500'
        ]);

        $transaction = Transactions::findOrFail($id);

        if ($transaction->status === Transactions::STATUS_COMPLETED) {
            return back()->with('success', 'Transaction is already completed.');
        }

        DB::beginTransaction();
        try {
            // Update transaction status
            TransactionService::approveTransaction($transaction, $request->admin_notes);

            // Handle specific transaction types
            if ($transaction->transaction_type === Transactions::TYPE_WITHDRAWAL) {
                // Additional withdrawal logic if needed
            } elseif ($transaction->transaction_type === Transactions::TYPE_DEPOSIT) {
                // Additional deposit logic if needed
            }

            DB::commit();
            return back()->with('success', 'Transaction approved successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to approve transaction: ' . $e->getMessage()]);
        }
    }

    /**
     * Reject a transaction
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500'
        ]);

        $transaction = Transactions::findOrFail($id);

        if ($transaction->status === Transactions::STATUS_CANCELLED) {
            return back()->with('success', 'Transaction is already cancelled.');
        }

        DB::beginTransaction();
        try {
            // Update transaction status
            TransactionService::rejectTransaction($transaction, $request->admin_notes);

            // Handle specific transaction types
            if ($transaction->transaction_type === Transactions::TYPE_WITHDRAWAL) {
                // Refund logic if needed
            }

            DB::commit();
            return back()->with('success', 'Transaction rejected successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to reject transaction: ' . $e->getMessage()]);
        }
    }

    /**
     * Mark transaction as failed
     */
    public function markAsFailed(Request $request, $id)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500'
        ]);

        $transaction = Transactions::findOrFail($id);

        if ($transaction->status === Transactions::STATUS_FAILED) {
            return back()->with('success', 'Transaction is already marked as failed.');
        }

        try {
            TransactionService::markTransactionAsFailed($transaction, $request->admin_notes);
            return back()->with('success', 'Transaction marked as failed successfully.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Failed to mark transaction as failed: ' . $e->getMessage()]);
        }
    }

    /**
     * Get transaction statistics for dashboard
     */
    public function statistics()
    {
        $statistics = TransactionService::getTransactionStatistics();
        $statisticsByType = TransactionService::getTransactionStatisticsByType();
        $recentTransactions = TransactionService::getRecentTransactions(10);

        return response()->json([
            'statistics' => $statistics,
            'statisticsByType' => $statisticsByType,
            'recentTransactions' => $recentTransactions
        ]);
    }

    /**
     * Export transactions
     */
    public function export(Request $request)
    {
        $filters = [
            'status' => $request->get('status'),
            'transaction_type' => $request->get('transaction_type'),
            'payment_method' => $request->get('payment_method'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];

        $transactions = TransactionService::searchTransactions(null, $filters, 1000);

        // Generate CSV or Excel export
        $filename = 'transactions_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($transactions) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, [
                'ID', 'User', 'Type', 'Amount', 'Currency', 'Status',
                'Payment Method', 'Payment Status', 'Description',
                'Created At', 'Processed At', 'Admin Notes'
            ]);

            foreach ($transactions as $transaction) {
                fputcsv($file, [
                    $transaction->id,
                    $transaction->username,
                    $transaction->transaction_type_text,
                    $transaction->amount,
                    $transaction->currency,
                    $transaction->status_text,
                    $transaction->payment_method_text,
                    $transaction->payment_status_text,
                    $transaction->description,
                    $transaction->created_at->format('Y-m-d H:i:s'),
                    $transaction->processed_at ? $transaction->processed_at->format('Y-m-d H:i:s') : '',
                    $transaction->admin_notes
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
