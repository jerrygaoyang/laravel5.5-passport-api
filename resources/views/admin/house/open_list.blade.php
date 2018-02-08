@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">开门记录</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Minton</a></li>
                        <li class="breadcrumb-item"><a href="#">房屋管理</a></li>
                        <li class="breadcrumb-item active">开门记录</li>
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
                                <th>房间</th>
                                <th>用户</th>
                                <td>开门时间</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>上海-xxx-xxx-xxx 1001室</td>
                                <td>高杨</td>
                                <td>2018-1-3 19:23</td>
                            </tr>
                            <tr>
                                <td>上海-xxx-xxx-xxx 1002室</td>
                                <td>小明</td>
                                <td>2018-1-2 16:23</td>
                            </tr>
                            <tr>
                                <td>上海-xxx-xxx-xxx 1003室</td>
                                <td>张三</td>
                                <td>2018-1-1 20:21</td>
                            </tr>
                            <tr>
                                <td>上海-xxx-xxx-xxx 1002室</td>
                                <td>小明</td>
                                <td>2018-1-1 19:15</td>
                            </tr>
                            <tr>
                                <td>上海-xxx-xxx-xxx 1001室</td>
                                <td>高杨</td>
                                <td>2018-12-20 15:23</td>
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