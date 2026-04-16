<?php

namespace App\Services;

use App\Models\Transactions;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionService
{
    /**
     * Create a new transaction
     */
    public static function createTransaction(array $data)
    {
        try {
            DB::beginTransaction();

            $transaction = Transactions::create($data);

            DB::commit();

            Log::info('Transaction created successfully', [
                'transaction_id' => $transaction->id,
                'user_id' => $transaction->user_id,
                'type' => $transaction->transaction_type,
                'amount' => $transaction->amount
            ]);

            return $transaction;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Failed to create transaction', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    /**
     * Create a deposit transaction
     */
    public static function createDepositTransaction(User $user, $amount, $currency = 'USD', $reference = null, $metadata = [])
    {
        return self::createTransaction([
            'user_id' => $user->id,
            'username' => $user->username,
            'fullname' => $user->firstname . ' ' . $user->lastname,
            'amount' => $amount,
            'status' => Transactions::STATUS_PENDING,
            'transaction_type' => Transactions::TYPE_DEPOSIT,
            'reference_id' => $reference ? $reference->id : null,
            'reference_type' => $reference ? get_class($reference) : null,
            'description' => "Deposit of {$amount} {$currency}",
            'currency' => $currency,
            'payment_method' => Transactions::PAYMENT_CRYPTO,
            'payment_status' => Transactions::PAYMENT_PENDING,
            'metadata' => $metadata
        ]);
    }

    /**
     * Create a withdrawal transaction
     */
    public static function createWithdrawalTransaction(User $user, $amount, $currency = 'USD', $reference = null, $metadata = [])
    {
        return self::createTransaction([
            'user_id' => $user->id,
            'username' => $user->username,
            'fullname' => $user->firstname . ' ' . $user->lastname,
            'amount' => $amount,
            'status' => Transactions::STATUS_PENDING,
            'transaction_type' => Transactions::TYPE_WITHDRAWAL,
            'reference_id' => $reference ? $reference->id : null,
            'reference_type' => $reference ? get_class($reference) : null,
            'description' => "Withdrawal request of {$amount} {$currency}",
            'currency' => $currency,
            'payment_method' => $metadata['method'] ?? Transactions::PAYMENT_CRYPTO,
            'payment_status' => Transactions::PAYMENT_PENDING,
            'metadata' => $metadata
        ]);
    }

    /**
     * Create a transfer transaction
     */
    public static function createTransferTransaction(User $user, $amount, $fromAddress, $toAddress, $currency = 'USD', $metadata = [])
    {
        return self::createTransaction([
            'user_id' => $user->id,
            'username' => $user->username,
            'fullname' => $user->firstname . ' ' . $user->lastname,
            'amount' => $amount,
            'status' => Transactions::STATUS_PENDING,
            'transaction_type' => Transactions::TYPE_TRANSFER,
            'description' => "Transfer of {$amount} {$currency}",
            'currency' => $currency,
            'payment_method' => Transactions::PAYMENT_WALLET,
            'payment_status' => Transactions::PAYMENT_PENDING,
            'from_address' => $fromAddress,
            'to_address' => $toAddress,
            'metadata' => $metadata
        ]);
    }

    /**
     * Create an exchange transaction
     */
    public static function createExchangeTransaction(User $user, $fromAmount, $toAmount, $fromCurrency, $toCurrency, $rate, $metadata = [])
    {
        return self::createTransaction([
            'user_id' => $user->id,
            'username' => $user->username,
            'fullname' => $user->firstname . ' ' . $user->lastname,
            'amount' => $fromAmount,
            'status' => Transactions::STATUS_PENDING,
            'transaction_type' => Transactions::TYPE_EXCHANGE,
            'description' => "Exchange {$fromAmount} {$fromCurrency} to {$toAmount} {$toCurrency}",
            'currency' => $fromCurrency,
            'payment_method' => Transactions::PAYMENT_WALLET,
            'payment_status' => Transactions::PAYMENT_PENDING,
            'exchange_rate' => $rate,
            'exchange_from_currency' => $fromCurrency,
            'exchange_to_currency' => $toCurrency,
            'metadata' => $metadata
        ]);
    }

    /**
     * Create a crypto trade transaction
     */
    public static function createCryptoTradeTransaction(User $user, $amount, $coinName, $coinRate, $payout, $metadata = [])
    {
        return self::createTransaction([
            'user_id' => $user->id,
            'username' => $user->username,
            'fullname' => $user->firstname . ' ' . $user->lastname,
            'amount' => $payout,
            'status' => Transactions::STATUS_PENDING,
            'transaction_type' => Transactions::TYPE_CRYPTO_TRADE,
            'description' => "Crypto trade: {$amount} {$coinName} at rate {$coinRate}",
            'currency' => 'USD',
            'payment_method' => Transactions::PAYMENT_CRYPTO,
            'payment_status' => Transactions::PAYMENT_PENDING,
            'metadata' => array_merge($metadata, [
                'coin_name' => $coinName,
                'coin_rate' => $coinRate,
                'trade_amount' => $amount
            ])
        ]);
    }

    /**
     * Create a card purchase transaction
     */
    public static function createCardPurchaseTransaction(User $user, $amount, $cardType, $metadata = [])
    {
        return self::createTransaction([
            'user_id' => $user->id,
            'username' => $user->username,
            'fullname' => $user->firstname . ' ' . $user->lastname,
            'amount' => $amount,
            'status' => Transactions::STATUS_PENDING,
            'transaction_type' => Transactions::TYPE_CARD_PURCHASE,
            'description' => "Card purchase: {$cardType}",
            'currency' => 'USD',
            'payment_method' => Transactions::PAYMENT_CARD,
            'payment_status' => Transactions::PAYMENT_PENDING,
            'metadata' => array_merge($metadata, [
                'card_type' => $cardType
            ])
        ]);
    }

    /**
     * Create a charge fee transaction
     */
    public static function createChargeFeeTransaction(User $user, $amount, $coinId, $metadata = [])
    {
        return self::createTransaction([
            'user_id' => $user->id,
            'username' => $user->username,
            'fullname' => $user->firstname . ' ' . $user->lastname,
            'amount' => $amount,
            'status' => Transactions::STATUS_PENDING,
            'transaction_type' => Transactions::TYPE_CHARGE_FEE,
            'description' => "Charge fee for coin ID: {$coinId}",
            'currency' => 'USD',
            'payment_method' => Transactions::PAYMENT_CRYPTO,
            'payment_status' => Transactions::PAYMENT_PENDING,
            'metadata' => array_merge($metadata, [
                'coin_id' => $coinId
            ])
        ]);
    }

    /**
     * Update transaction status
     */
    public static function updateTransactionStatus(Transactions $transaction, $status, $notes = null)
    {
        try {
            $transaction->update([
                'status' => $status,
                'processed_at' => now(),
                'admin_notes' => $notes
            ]);

            Log::info('Transaction status updated', [
                'transaction_id' => $transaction->id,
                'new_status' => $status,
                'notes' => $notes
            ]);

            return $transaction;

        } catch (\Exception $e) {
            Log::error('Failed to update transaction status', [
                'transaction_id' => $transaction->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    /**
     * Approve transaction
     */
    public static function approveTransaction(Transactions $transaction, $notes = null)
    {
        return self::updateTransactionStatus($transaction, Transactions::STATUS_COMPLETED, $notes);
    }

    /**
     * Reject transaction
     */
    public static function rejectTransaction(Transactions $transaction, $notes = null)
    {
        return self::updateTransactionStatus($transaction, Transactions::STATUS_CANCELLED, $notes);
    }

    /**
     * Mark transaction as failed
     */
    public static function markTransactionAsFailed(Transactions $transaction, $notes = null)
    {
        return self::updateTransactionStatus($transaction, Transactions::STATUS_FAILED, $notes);
    }

    /**
     * Get user transaction history
     */
    public static function getUserTransactionHistory($userId, $limit = 20)
    {
        return Transactions::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    /**
     * Get transactions by type
     */
    public static function getTransactionsByType($type, $limit = 20)
    {
        return Transactions::ofType($type)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    /**
     * Get pending transactions
     */
    public static function getPendingTransactions($limit = 20)
    {
        return Transactions::pending()
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->paginate($limit);
    }

    /**
     * Get transaction statistics
     */
    public static function getTransactionStatistics()
    {
        return [
            'total' => Transactions::count(),
            'pending' => Transactions::pending()->count(),
            'completed' => Transactions::completed()->count(),
            'cancelled' => Transactions::cancelled()->count(),
            'failed' => Transactions::failed()->count(),
            'processing' => Transactions::processing()->count(),
        ];
    }

    /**
     * Get transaction statistics by type
     */
    public static function getTransactionStatisticsByType()
    {
        return Transactions::selectRaw('transaction_type, COUNT(*) as count, SUM(amount) as total_amount')
            ->groupBy('transaction_type')
            ->get()
            ->keyBy('transaction_type');
    }

    /**
     * Get recent transactions
     */
    public static function getRecentTransactions($limit = 10)
    {
        return Transactions::with('user')
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Search transactions
     */
    public static function searchTransactions($query, $filters = [], $limit = 20)
    {
        $transactions = Transactions::query();

        // Search by username, description, or transaction ID
        if ($query) {
            $transactions->where(function($q) use ($query) {
                $q->where('username', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%")
                  ->orWhere('id', 'like', "%{$query}%");
            });
        }

        // Apply filters
        if (isset($filters['status'])) {
            $transactions->where('status', $filters['status']);
        }

        if (isset($filters['transaction_type'])) {
            $transactions->where('transaction_type', $filters['transaction_type']);
        }

        if (isset($filters['payment_method'])) {
            $transactions->where('payment_method', $filters['payment_method']);
        }

        if (isset($filters['date_from'])) {
            $transactions->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to'])) {
            $transactions->whereDate('created_at', '<=', $filters['date_to']);
        }

        return $transactions->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }
}
