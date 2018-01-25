@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">编辑房屋信息</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Minton</a></li>
                        <li class="breadcrumb-item"><a href="#">房屋管理</a></li>
                        <li class="breadcrumb-item active">编辑房屋信息</li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('admin/house/info/'.$houseinfo->id) }}" method="post">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group">
                                <label for="house_acreage">房屋面积</label>
                                <input type="number" class="form-control" id="house_acreage" name="house_acreage" value="{{ $houseinfo->house_acreage }}">
                            </div>
                            <div class="form-group">
                                <label for="house_address">房屋地址</label>
                                <input type="text" class="form-control" id="house_address" name="house_address" value="{{ $houseinfo->house_address }}">
                            </div>
                            <div class="form-group">
                                <label for="rent_price">租赁价格</label>
                                <input type="number" class="form-control" id="rent_price" name="rent_price" value="{{ $houseinfo->rent_price }}">
                            </div>
                            <div class="form-group">
                                <label for="house_date_start">空置期：开始时间</label>
                                <input type="text" class="form-control" id="house_date_start" name="house_date_start" value="{{ $houseinfo->house_date_start }}">
                            </div>
                            <div class="form-group">
                                <label for="house_date_end">空置期：结束时间</label>
                                <input type="text" class="form-control" id="house_date_end" name="house_date_end" value="{{ $houseinfo->house_date_end }}">
                            </div>
                            <div class="form-group">
                                <label for="house_decoration">房屋配置</label>
                                <textarea type="text" class="form-control" id="house_decoration" name="house_decoration">{{ $houseinfo->house_decoration }}</textarea>
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