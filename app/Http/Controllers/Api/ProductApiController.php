<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Validations\Api\ProductApiValidation;
use App\Services\Api\ProductApiService;

class ProductApiController extends Controller
{
    /**
     ** Validation instance.
     *
     * @var \App\Validations\Api\ProductApiValidation
     */
    protected $productApiValidation;

    /**
     ** Service instance.
     *
     * @var \App\Services\Api\ProductApiService
     */
    protected $productApiService;

    /**
     ** Create a new instance.
     *
     * @return void
     */
    public function __construct(ProductApiValidation $productApiValidation, ProductApiService $productApiService)
    {
        $this->productApiValidation = $productApiValidation;
        $this->productApiService = $productApiService;
    }

    /**
     ** Index.
     *
     * @param \App\Http\Requests\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validation = $this->productApiValidation->index($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->productApiService->index($request);

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
        $request['product_id'] = $request->product_id;
        $validation = $this->productApiValidation->show($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->productApiService->show($request);

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
        $validation = $this->productApiValidation->create($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->productApiService->create($request);

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
        $request['product_id'] = $request->product_id;
        $validation = $this->productApiValidation->update($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->productApiService->update($request);

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
        $request['product_id'] = $request->product_id;
        $validation = $this->productApiValidation->destroy($request);

        if (!$validation->status) {
            return $this->formatResponse($validation);
        }

        $result = $this->productApiService->destroy($request);

        return $this->formatResponse($result);
    }
}
