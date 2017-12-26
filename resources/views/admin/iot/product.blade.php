@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">产品列表</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Minton</a></li>
                        <li class="breadcrumb-item"><a href="#">IOT套件</a></li>
                        <li class="breadcrumb-item active">产品管理</li>
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
                                <button class="btn btn-custom btn-success" onclick="create()">
                                    添加
                                </button>
                            </div>
                        </div>

                        <table class="table table-bordered" id="datatable-editable">
                            <thead>
                            <tr>
                                <th>产品名称</th>
                                <th>产品 Key</th>
                                <th>产品描述</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_key }}</td>
                                    <td>{{ $product->product_description }}</td>
                                    <td>
                                        <a onclick="update({{ $product->id }})" class="on-default edit-row my-handle"
                                           data-toggle="tooltip" data-placement="top" data-original-title="编辑">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a onclick="destroy({{ $product->id }})" class="on-default remove-row my-handle"
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
                    <h4 class="modal-title">操作产品</h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id">
                    <div class="form-group">
                        <label for="product_name">产品名称</label>
                        <input id="product_name" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="product_description">产品描述</label>
                        <textarea id="product_description" type="text" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary" onclick="save()">保存</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('script')
    <script>
        function create() {
            $('#product_name').val('');
            $('#product_description').val('');
            $('#myModal').modal('show');
        }

        function update(id) {
            $.ajax({
                url: '/admin/iot/product/' + id + '/edit',
                type: 'get',
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    $('#id').val(id);
                    $('#product_name').val(res.data.product_name);
                    $('#product_description').val(res.data.product_description);
                    $('#myModal').modal('show');
                }
            })
        }

        function save() {

            var id = $('#id').val();
            var product_name = $('#product_name').val();
            var product_description = $('#product_description').val();

            var data = {
                product_name: product_name,
                product_description: product_description
            };

            var url = '/admin/iot/product/';
            var type = 'post';

            if (id) {
                url += id;
                type = 'put'
            }

            $.ajax({
                url: url,
                type: type,
                dataType: 'json',
                data: data,
                success: function (res) {
                    if (res.code === 0) {
                        layer.msg('操作成功', {icon: 1});
                        $('#myModal').modal('hide');
                        location.href = window.location.href
                    }
                    console.log(res)
                }
            })
        }

        function destroy(id) {
            layer.alert('确定删除该产品吗？', function () {
                $.ajax({
                    url: '/admin/iot/product/' + id,
                    type: 'delete',
                    dataType: 'json',
                    data: data,
                    success: function (res) {
                        if (res.code === 0) {
                            layer.msg('删除成功', {icon: 1});
                            location.href = window.location.href
                        } else {
                            layer.msg('删除失败', {icon: 1});
                        }
                        console.log(res)
                    }
                })
            })
        }
    </script>
@endsection