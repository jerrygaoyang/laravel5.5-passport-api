@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">添加小区</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Minton</a></li>
                        <li class="breadcrumb-item"><a href="#">房屋管理</a></li>
                        <li class="breadcrumb-item active">添加小区</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('admin/house/area') }}" method="post">
                            <div class="form-group">
                                <label for="area_name">小区名称</label>
                                <input type="text" class="form-control" id="area_name" name="area_name">
                            </div>
                            <div class="form-group">
                                <label for="area_address">地理位置</label>
                                <textarea type="text" class="form-control" id="area_address" name="area_address"></textarea>
                            </div>
                            <button class="btn btn-primary">提交保存</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

    </div>
    <!-- end container -->

@endsection

@section('script')
    <script></script>
@endsection