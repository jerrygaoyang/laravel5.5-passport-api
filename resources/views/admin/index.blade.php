@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Starter</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Minton</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
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
                                <button class="btn btn-custom btn-success">添加</button>
                            </div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Rendering engine</th>
                                <th>Browser</th>
                                <th>Platform(s)</th>
                                <th>Actions</th>
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