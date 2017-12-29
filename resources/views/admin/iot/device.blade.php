@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">设备列表</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Minton</a></li>
                        <li class="breadcrumb-item"><a href="#">IOT套件</a></li>
                        <li class="breadcrumb-item active">设备管理</li>
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
                                <button class="btn btn-custom btn-success" data-toggle="modal" data-target="#myModal">
                                    添加
                                </button>
                            </div>
                        </div>

                        <table class="table table-bordered" id="datatable-editable">
                            <thead>
                            <tr>
                                <th>IOT设备 ID</th>
                                <th>IOT产品 Key</th>
                                <th>微信设备 ID</th>
                                <th>设备 Mac</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($devices as $device)
                                <tr>
                                    <td>{{ $device->device_id }}</td>
                                    <td>{{ $device->product_key }}</td>
                                    <td>{{ $device->device_name }}</td>
                                    <td>{{ $device->device_mac }}</td>
                                    <td>
                                        <a class="on-default edit-row my-handle"
                                           data-toggle="tooltip" data-placement="top" data-original-title="编辑">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="on-default remove-row my-handle"
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

    <div class="modal fade" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">添加设备</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="device_mac">设备 Mac</label>
                        <input id="device_mac" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="product_key">所属产品</label>
                        <select id="product_key" class="form-control">
                            @foreach($products as $product)
                                <option value="{{ $product->product_key }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" onclick="create()">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('script')
    <script>
        function create() {
            var data = {
                'device_mac': $('#device_mac').val(),
                'product_key': $('#product_key').val()
            };
            $.ajax({
                url: '/admin/iot/device',
                type: 'post',
                dataType: 'json',
                data: data,
                success: function (res) {
                    if (res.code === 0) {
                        layer.msg('添加成功', {icon: 1});
                        location.href = window.location.href;
                    } else {
                        layer.msg('添加失败', {icon: 2});
                    }
                    console.log(res);
                }
            })
        }
    </script>
@endsection