<?php

namespace App\Http\Controllers\Admin\Iot;

use App\Helpers\Api\ApiResponse;
use App\Helpers\Iot\CreateProduct;
use App\Helpers\Iot\UpdateProduct;
use App\Models\IotProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = IotProduct::paginate(15);
        return view('admin.iot.product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return ProductController
     */
    public function store(Request $request)
    {
        $product_name = $request->post('product_name');
        $product_description = $request->post('product_description');

        /**
         * 前往iot套件云，创建产品
         */
        $res = CreateProduct::execute($product_name, $product_description);
        $product_key = $res['ProductInfo']['ProductKey'];

        /**
         * 产品信息同步到本地服务器
         */
        $product = IotProduct::create([
            'product_key' => $product_key,
            'product_name' => $product_name,
            'product_description' => $product_description
        ]);

        return $this->success($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return ProductController
     */
    public function edit($id)
    {
        $product = IotProduct::find($id);
        return $this->success($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return ProductController
     */
    public function update(Request $request, $id)
    {
        $product_name = $request->post('product_name');
        $product_description = $request->post('product_description');

        /**
         * 查询本地服务器产品信息，获取 product_key
         */
        $product = IotProduct::find($id);
        $product_key = $product->product_key;

        /**
         * 前往iot套件云，更新产品
         */
        UpdateProduct::execute($product_key, $product_name, $product_description);

        /**
         * 更新到本地服务器产品信息
         */
        IotProduct::where('id', $id)->update([
            'product_name' => $product_name,
            'product_description' => $product_description
        ]);

        return $this->success($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return ProductController
     */
    public function destroy($id)
    {
        IotProduct::where('id', $id)->delete();
        return $this->success();
    }
}
