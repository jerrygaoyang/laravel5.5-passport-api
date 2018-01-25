@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">添加房屋</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Minton</a></li>
                        <li class="breadcrumb-item"><a href="#">房屋管理</a></li>
                        <li class="breadcrumb-item active">添加房屋</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('admin/house/info') }}" method="post">
                            <div class="form-group">
                                <label for="house_acreage">房屋面积</label>
                                <input type="number" class="form-control" id="house_acreage" name="house_acreage">
                            </div>
                            <div class="form-group">
                                <label for="house_address">房屋地址</label>
                                <input type="text" class="form-control" id="house_address" name="house_address">
                            </div>
                            <div class="form-group">
                                <label for="rent_price">租赁价格</label>
                                <input type="number" class="form-control" id="rent_price" name="rent_price">
                            </div>
                            <div class="form-group">
                                <label for="house_date_start">空置期：开始时间</label>
                                <input type="text" class="form-control" id="house_date_start" name="house_date_start">
                            </div>
                            <div class="form-group">
                                <label for="house_date_end">空置期：结束时间</label>
                                <input type="text" class="form-control" id="house_date_end" name="house_date_end">
                            </div>
                            <div class="form-group">
                                <label for="house_decoration">房屋配置</label>
                                <textarea type="text" class="form-control" id="house_decoration" name="house_decoration"></textarea>
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