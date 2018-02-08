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
                                <th>租赁状态</th>
                                <th>面积（㎡）</th>
                                <td>价格（元）</td>
                                <th>地址</th>
                                <th>空置期</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>

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