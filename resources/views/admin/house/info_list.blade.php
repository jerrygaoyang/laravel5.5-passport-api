@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">房屋列表</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Minton</a></li>
                        <li class="breadcrumb-item"><a href="#">房屋管理</a></li>
                        <li class="breadcrumb-item active">房屋列表</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row card-title">
                            <div class="col-sm-4">
                                <input type="search" class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-outline-primary">搜索</button>
                            </div>
                            <div class="col-sm-4 text-right">
                                <button class="btn btn-custom btn-success"
                                        onclick="location.href='{{ url('admin/house/info/create') }}'">
                                    添加
                                </button>
                            </div>
                        </div>

                        <table class="table table-bordered" id="datatable-editable">
                            <thead>
                            <tr>
                                <th>租赁状态</th>
                                <th>面积</th>
                                <td>价格</td>
                                <th>地址</th>
                                <th>空置期</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($houseinfos as $houseinfo)
                                <tr>
                                    <td>@if($houseinfo->is_rent) 已出租 @else 空置 @endif</td>
                                    <td>{{ $houseinfo->house_acreage }}</td>
                                    <td>{{ $houseinfo->rent_price }}</td>
                                    <td>{{ $houseinfo->house_address }}</td>
                                    <td>{{ $houseinfo->house_date_start }}-{{ $houseinfo->house_date_end }}</td>
                                    <td>
                                        <a href="{{ url('admin/house/info/'.$houseinfo->id.'/edit') }}"
                                           class="on-default edit-row my-handle"
                                           data-toggle="tooltip" data-placement="top" data-original-title="编辑">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a onclick="destroy({{ $houseinfo->id }})"
                                           class="on-default remove-row my-handle"
                                           data-toggle="tooltip" data-placement="top" data-original-title="删除">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div>
    <!-- end container -->

@endsection

@section('script')
    <script>
        function destroy(id) {
            layer.alert('确认删除该数据吗？', function () {
                $.ajax({
                    url: '/admin/house/info/' + id,
                    method: 'delete',
                    dataType: 'json',
                    success: function (res) {
                        if (res.code === 0) {
                            layer.msg('删除成功', {icon: 1});
                            location.href = window.location.href
                        }
                    }
                })
            })
        }
    </script>
@endsection