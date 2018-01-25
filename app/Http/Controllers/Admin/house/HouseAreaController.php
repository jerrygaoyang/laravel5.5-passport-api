<?php

namespace App\Http\Controllers\Admin\house;

use App\Helpers\Api\ApiResponse;
use App\Models\HouseArea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HouseAreaController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = HouseArea::paginate(15);
        return view('admin.house.area_list', ['areas' => $areas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.house.area_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        HouseArea::create($request->input());
        return redirect('admin/house/area');
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
        $area = HouseArea::find($id);
        return view('admin.house.area_edit', ['area' => $area]);
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
        HouseArea::where('id', $id)->update($request->except(['_method']));
        return redirect('admin/house/area');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return HouseAreaController
     */
    public function destroy($id)
    {
        HouseArea::destroy($id);
        return $this->success();
    }
}
