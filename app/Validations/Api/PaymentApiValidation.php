<?php

namespace App\Validations\Api;

use Illuminate\Validation\Rule;

use App\Helpers\MessageHelper;

class PaymentApiValidation
{
    /**
     ** Summary transaction validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function summaryTransaction($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     ** Detail transaction validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function detailTransaction($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $validate = [
            'user_id' => ['required', 'exists:users,id'],
            'page' => ['required', 'numeric'],
            'per_page' => ['required', 'numeric'],
            'sort_key' => ['required', Rule::in(['amount', 'status', 'created_at'])],
            'sort_order' => ['required', Rule::in(['asc', 'desc'])],
        ];

        $errorMessage = [
            'user_id.required' => 'ID user tidak boleh kosong !',
            'user_id.exists' => 'ID user tidak ditemukan !',

            'page.required' => 'Halaman tidak boleh kosong !',
            'page.numeric' => 'Halaman harus berupa angka !',

            'per_page.required' => 'Jumlah per halaman tidak boleh kosong !',
            'per_page.numeric' => 'Jumlah per halaman harus berupa angka !',

            'sort_key.required' => 'Kolom urutan tidak boleh kosong !',
            'sort_key.in' => 'Kolom urutan harus bernilai amount, status, atau created_at !',

            'sort_order.required' => 'Tipe urutan tidak boleh kosong !',
            'sort_order.in' => 'Tipe urutan harus bernilai asc atau desc !',
        ];

        $request->validate($validate, $errorMessage);

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     ** Create transaction validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function createTransaction($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $validate = [
            'user_id' => ['required', 'exists:users,id'],
            'amount' => ['required', 'decimal:2'],
        ];

        $errorMessage = [
            'user_id.required' => 'ID user tidak boleh kosong !',
            'user_id.exists' => 'ID user tidak ditemukan !',

            'amount.required' => 'Jumlah biaya tidak boleh kosong !',
            'amount.decimal' => 'Jumlah biaya harus berupa angka dengan 2 angka dibelakang koma !',
        ];

        $request->validate($validate, $errorMessage);

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     ** Update transaction validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function updateTransaction($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $validate = [
            'transaction_id' => ['required', 'exists:transactions,id'],
            'status' => ['required', Rule::in(['Completed', 'Failed'])],
        ];

        $errorMessage = [
            'transaction_id.required' => 'ID transaksi tidak boleh kosong !',
            'transaction_id.exists' => 'ID transaksi tidak ditemukan !',

            'status.required' => 'Status transaksi tidak boleh kosong !',
            'status.in' => 'Status transaksi harus bernilai Completed atau Failed !',
        ];

        $request->validate($validate, $errorMessage);

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
