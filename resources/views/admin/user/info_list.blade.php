@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">用户列表</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Minton</a></li>
                        <li class="breadcrumb-item"><a href="#">用户管理</a></li>
                        <li class="breadcrumb-item active">用户列表</li>
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
                        </div>

                        <table class="table table-bordered" id="datatable-editable">
                            <thead>
                            <tr>
                                <th>用户</th>
                                <th>手机</th>
                                <th>性别</th>
                                <th>房间</th>
                                <td>租赁时间</td>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>高杨</td>
                                <td>18888888888</td>
                                <td>男</td>
                                <td>上海-xxx-xxx-xxx 1001室</td>
                                <td>2018-01-03 至 2010-01-03</td>
                                <td>
                                    <a href="#"
                                       class="on-default edit-row my-handle"
                                       data-toggle="tooltip" data-placement="top" data-original-title="编辑">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a onclick="" class="on-default remove-row my-handle"
                                       data-toggle="tooltip" data-placement="top" data-original-title="删除">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>小明</td>
                                <td>18888888888</td>
                                <td>男</td>
                                <td>上海-xxx-xxx-xxx 1002室</td>
                                <td>2018-01-02 至 2019-01-02</td>
                                <td>
                                    <a href="#"
                                       class="on-default edit-row my-handle"
                                       data-toggle="tooltip" data-placement="top" data-original-title="编辑">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a onclick="" class="on-default remove-row my-handle"
                                       data-toggle="tooltip" data-placement="top" data-original-title="删除">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>张三</td>
                                <td>18888888888</td>
                                <td>男</td>
                                <td>上海-xxx-xxx-xxx 1003室</td>
                                <td>2018-01-01 至 2019-01-01</td>
                                <td>
                                    <a href="#"
                                       class="on-default edit-row my-handle"
                                       data-toggle="tooltip" data-placement="top" data-original-title="编辑">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a onclick="" class="on-default remove-row my-handle"
                                       data-toggle="tooltip" data-placement="top" data-original-title="删除">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>李四</td>
                                <td>18888888888</td>
                                <td>上海-xxx-xxx-xxx 1002室</td>
                                <td>2018-01-01 至 2019-01-01</td>
                                <td>
                                    <a href="#"
                                       class="on-default edit-row my-handle"
                                       data-toggle="tooltip" data-placement="top" data-original-title="编辑">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a onclick="" class="on-default remove-row my-handle"
                                       data-toggle="tooltip" data-placement="top" data-original-title="删除">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
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