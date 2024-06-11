<?php

namespace App\Services\Api;

use Illuminate\Support\Facades\Cache;

use App\Helpers\MessageHelper;

use App\Jobs\UpdateTransactionJob;

use App\Models\Transaction;

class PaymentApiService
{
    /**
     ** Summary transaction service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function summaryTransaction($request)
    {
        $status = true;
        $message = MessageHelper::retrievedSuccess();

        $totalTransactions = Transaction::sum('amount');
        $averageAmount = Transaction::avg('amount');
        $highestTransaction = Transaction::max('amount');
        $lowestTransaction = Transaction::min('amount');

        $longestNameTransaction = Transaction::all()
            ->sortByDesc('user.name')
            ->first();

        $pending = Transaction::where('status', 'Pending')->count();
        $completed = Transaction::where('status', 'Completed')->count();
        $failed = Transaction::where('status', 'Failed')->count();

        $data = [
            'total_transactions' => $totalTransactions,
            'average_amount' => $averageAmount,
            'highest_transaction' => $highestTransaction,
            'lowest_transaction' => $lowestTransaction,
            'longest_name_transaction' => $longestNameTransaction,
            'status_distribution' => [
                'Pending' => $pending,
                'Completed' => $completed,
                'Failed' => $failed,
            ],
        ];

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return $result;
    }

    /**
     ** Detail transaction service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function detailTransaction($request)
    {
        $status = true;
        $message = MessageHelper::retrievedSuccess();

        $transaction = Cache::remember('transaction_' . $request->user_id, now()->addMinutes(150), function () use ($request) {
            return Transaction::where('user_id', $request->user_id)
                ->getPaginatedData(true, $request->page, $request->per_page, $request->sort_key, $request->sort_order);
        });

        $data = $transaction->data;
        $pagination = $transaction->pagination;

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'pagination' => $pagination,
        ];

        return $result;
    }

    /**
     ** Create transaction service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function createTransaction($request)
    {
        $status = true;
        $message = MessageHelper::savedSuccess();

        $data = [
            'user_id' => $request->user_id,
            'amount' => $request->amount,
        ];

        $transaction = Transaction::create($data);

        $data = Transaction::firstWhere('id', $transaction->id);

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return $result;
    }

    /**
     ** Update transaction service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function updateTransaction($request)
    {
        $status = true;
        $message = MessageHelper::savedSuccess();

        $params = (object) [
            'transaction_id' => $request->transaction_id,
            'status' => $request->status,
        ];

        UpdateTransactionJob::dispatch($params);

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
