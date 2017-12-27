<?php

namespace App\Http\Controllers\Device;

use App\Helpers\Api\ApiResponse;
use App\Helpers\Iot\RegisterDevice;
use App\Models\IotDevice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeviceController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
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
     * @return DeviceController
     */
    public function store(Request $request)
    {
        $device_mac = $request->post('device_mac');
        $product_key = $request->post('product_key');

        /**
         * 去阿里iot套件云注册设备
         */
        $register_device = RegisterDevice::execute($product_key);

        /**
         * 设备信息同步到本地服务器
         */
        $device = IotDevice::create([
            'device_id' => $register_device['DeviceId'],
            'device_name' => $register_device['DeviceName'],
            'device_secret' => $register_device['DeviceSecret'],
            'device_mac' => $device_mac,
            'product_key' => $product_key
        ]);

        return $this->success($device);
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
     * @return void
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}
