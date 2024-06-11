<?php

namespace App\Services\Api;

use App\Helpers\MessageHelper;

use App\Models\ProductCategory;

class ProductCategoryApiService
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

        $productCategory = ProductCategory::filter($filter)
            ->search($request->search)
            ->getPaginatedData($paginate, $request->page, $request->per_page, $sortKey, $sortOrder);

        if ($request->paginate == 'Ya') {
            $data = $productCategory->data;
            $pagination = $productCategory->pagination;
        } else {
            $data = $productCategory;
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

        $data = ProductCategory::firstWhere('id', $request->product_category_id);

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
            'name' => $request->name,
            'description' => $request->description,
        ];

        $productCategory = ProductCategory::create($data);

        $data = ProductCategory::firstWhere('id', $productCategory->id);

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
            'name' => $request->name,
            'description' => $request->description,
        ];

        ProductCategory::where('id', $request->product_category_id)
            ->update($data);

        $data = ProductCategory::firstWhere('id', $request->product_category_id);

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

        ProductCategory::where('id', $request->product_category_id)
            ->delete();

        $result = (object) [
            'status' => $status,
            'message' => $message,
        ];

        return $result;
    }
}
