<?php

namespace App\Http\Controllers\Admin\house;

use App\Helpers\Api\ApiResponse;
use App\Models\HouseInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HouseInfoController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houseinfos = HouseInfo::paginate(15);
        return view('admin.house.info_list', ['houseinfos' => $houseinfos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.house.info_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HouseInfo::create($request->input());
        return redirect('admin/house/info');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $houseinfo = HouseInfo::find($id);
        return view('admin.house.info_edit', ['houseinfo' => $houseinfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        HouseInfo::where('id', $id)->update($request->except(['_method']));
        return redirect('admin/house/info');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return HouseInfoController
     */
    public function destroy($id)
    {
        HouseInfo::destroy($id);
        return $this->success();
    }
}
