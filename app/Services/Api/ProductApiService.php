<?php

namespace App\Services\Api;

use App\Helpers\MessageHelper;

use App\Models\Product;

class ProductApiService
{
    /**
     ** Index service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function index($request)
    {
        $status = true;
        $message = MessageHelper::retrievedSuccess();

        $filter = [];
        $paginate = true;
        $sortKey = 'name';
        $sortOrder = 'asc';

        if (isset($request->filter['name']) and $request->filter['name']) {
            $filter['name'] = $request->filter['name'];
        }

        if ($request->paginate == 'Tidak') {
            $paginate = false;
        }

        if (isset($request->sort_key) and $request->sort_key) {
            $sortKey = $request->sort_key;
        }

        if (isset($request->sort_order) and $request->sort_order) {
            $sortOrder = $request->sort_order;
        }

        $product = Product::filter($filter)
            ->search($request->search)
            ->getPaginatedData($paginate, $request->page, $request->per_page, $sortKey, $sortOrder);

        if ($request->paginate == 'Ya') {
            $data = $product->data;
            $pagination = $product->pagination;
        } else {
            $data = $product;
            $pagination = null;
        }

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'pagination' => $pagination,
        ];

        return $result;
    }

    /**
     ** Show service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function show($request)
    {
        $status = true;
        $message = MessageHelper::retrievedSuccess();

        $data = Product::firstWhere('id', $request->product_id);

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return $result;
    }

    /**
     ** Create service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function create($request)
    {
        $status = true;
        $message = MessageHelper::savedSuccess();

        $data = [
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'price' => $request->price,
        ];

        $product = Product::create($data);

        if ($request->image) {
            Product::saveImage($product->id, $request->image);
        }

        $data = Product::firstWhere('id', $product->id);

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return $result;
    }

    /**
     ** Update service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function update($request)
    {
        $status = true;
        $message = MessageHelper::savedSuccess();

        $data = [
            'product_category_id' => $request->product_category_id,
            'name' => $request->name,
            'price' => $request->price,
        ];

        Product::where('id', $request->product_id)
            ->update($data);

        if ($request->image) {
            Product::deleteImage($request->product_id);
            Product::saveImage($request->product_id, $request->image);
        }

        $data = Product::firstWhere('id', $request->product_id);

        $result = (object) [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return $result;
    }

    /**
     ** Destroy service.
     *
     * @param $request
     * @return ArrayObject
     */
    public function destroy($request)
    {
        $status = true;
        $message = MessageHelper::deletedSuccess();

        Product::deleteImage($request->product_id);
        Product::where('id', $request->product_id)
            ->delete();

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
