<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Validations\Api\ProductCategoryApiValidation;
use App\Services\Api\ProductCategoryApiService;

class ProductCategoryApiController extends Controller
{
    /**
     ** Validation instance.
     *
     * @var \App\Validations\Api\ProductCategoryApiValidation
     */
    protected $productCategoryApiValidation;

    /**
     ** Service instance.
     *
     * @var \App\Services\Api\ProductCategoryApiService
     */
    protected $productCategoryApiService;

    /**
     ** Create a new instance.
     *
     * @return void
     */
    public function __construct(ProductCategoryApiValidation $productCategoryApiValidation, ProductCategoryApiService $productCategoryApiService)
    {
        $this->productCategoryApiValidation = $productCategoryApiValidation;
        $this->productCategoryApiService = $productCategoryApiService;
    }

    /**
     ** Index.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validation = $this->productCategoryApiValidation->index($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->productCategoryApiService->index($request);

        return $this->formatResponse($result);
    }

    /**
     ** Show.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request['product_category_id'] = $request->product_category_id;
        $validation = $this->productCategoryApiValidation->show($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->productCategoryApiService->show($request);

        return $this->formatResponse($result);
    }

    /**
     ** Create.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validation = $this->productCategoryApiValidation->create($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->productCategoryApiService->create($request);

        return $this->formatResponse($result);
    }

    /**
     ** Update.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request['product_category_id'] = $request->product_category_id;
        $validation = $this->productCategoryApiValidation->update($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->productCategoryApiService->update($request);

        return $this->formatResponse($result);
    }

    /**
     ** Destroy.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request['product_category_id'] = $request->product_category_id;
        $validation = $this->productCategoryApiValidation->destroy($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->productCategoryApiService->destroy($request);

        return $this->formatResponse($result);
    }
}
