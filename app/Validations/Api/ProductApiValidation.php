<?php

namespace App\Validations\Api;

use Illuminate\Validation\Rule;

use App\Helpers\MessageHelper;

class ProductApiValidation
{
    /**
     ** Index validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function index($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $validate = [
            'paginate' => ['required', Rule::in(['Ya', 'Tidak'])],
            'page' => ['required_if:paginate,Ya', 'numeric'],
            'per_page' => ['required_if:paginate,Ya', 'numeric'],
            'search' => ['nullable'],
            'sort_key' => ['nullable', Rule::in(['id', 'name', 'price', 'created_at'])],
            'sort_order' => ['nullable', Rule::in(['asc', 'desc'])],
        ];

        $errorMessage = [
            'paginate.required' => 'Paginasi tidak boleh kosong !',
            'paginate.in' => 'Paginasi harus berisi Ya atau Tidak !',

            'page.required_if' => 'Halaman tidak boleh kosong !',
            'page.numeric' => 'Halaman harus berupa angka !',

            'per_page.required_if' => 'Jumlah per halaman tidak boleh kosong !',
            'per_page.numeric' => 'Jumlah per halaman harus berupa angka !',

            'sort_key.in' => 'Urutan berdasarkan harus berisi id, name, price, atau created_at !',

            'sort_order.in' => 'Tipe urutan harus berisi asc atau desc !',
        ];

        $request->validate($validate, $errorMessage);

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     ** Show validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function show($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $validate = [
            'product_id' => ['required', 'numeric', 'exists:products,id'],
        ];

        $errorMessage = [
            'product_id.required' => 'ID produk tidak boleh kosong !',
            'product_id.numeric' => 'ID produk harus berupa angka !',
            'product_id.exists' => 'ID produk tidak ditemukan !',
        ];

        $request->validate($validate, $errorMessage);

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     ** Create validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function create($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $validate = [
            'product_category_id' => ['required', 'numeric', 'exists:product_categories,id'],
            'name' => ['required'],
            'price' => ['required', 'numeric'],
        ];

        $errorMessage = [
            'product_category_id.required' => 'ID kategori produk tidak boleh kosong !',
            'product_category_id.numeric' => 'ID kategori produk harus berupa angka !',
            'product_category_id.exists' => 'ID kategori produk tidak ditemukan !',

            'name.required' => 'Nama produk tidak boleh kosong !',

            'price.required' => 'Harga produk tidak boleh kosong !',
            'price.numeric' => 'Harga produk harus berupa angka !',
        ];

        $request->validate($validate, $errorMessage);

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     ** Update validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function update($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $validate = [
            'product_id' => ['required', 'numeric', 'exists:products,id'],
            'product_category_id' => ['required', 'numeric', 'exists:product_categories,id'],
            'name' => ['required'],
            'price' => ['required', 'numeric'],
        ];

        $errorMessage = [
            'product_id.required' => 'ID produk tidak boleh kosong !',
            'product_id.numeric' => 'ID produk harus berupa angka !',
            'product_id.exists' => 'ID produk tidak ditemukan !',

            'product_category_id.required' => 'ID kategori produk tidak boleh kosong !',
            'product_category_id.numeric' => 'ID kategori produk harus berupa angka !',
            'product_category_id.exists' => 'ID kategori produk tidak ditemukan !',

            'name.required' => 'Nama produk tidak boleh kosong !',

            'price.required' => 'Harga produk tidak boleh kosong !',
            'price.numeric' => 'Harga produk harus berupa angka !',
        ];

        $request->validate($validate, $errorMessage);

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }

    /**
     ** Destroy validation.
     *
     * @param $request
     * @return ArrayObject
     */
    public function destroy($request)
    {
        $status = true;
        $message = MessageHelper::validationSuccess();

        $validate = [
            'product_id' => ['required', 'numeric', 'exists:products,id'],
        ];

        $errorMessage = [
            'product_id.required' => 'ID produk tidak boleh kosong !',
            'product_id.numeric' => 'ID produk harus berupa angka !',
            'product_id.exists' => 'ID produk tidak ditemukan !',
        ];

        $request->validate($validate, $errorMessage);

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
