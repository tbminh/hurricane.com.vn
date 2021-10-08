@extends('layout.layout_admin')
@section('title','Xem chi tiết sản phẩm')

@section('link_css')

@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('page-admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('page-list-product') }}">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Xem chi tiết</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection



@section('content')
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="col-10">
                            <img src="{{url('public/home/upload_img'.$view_detail->product_img)}}" style="width: 600px;">
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{$view_detail->product_name}}</h3>
                        <p>{{$view_detail->product_decribe}}</p>

                        <hr>

                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                {{ number_format($view_detail->product_price) }} VND
                            </h2>
                            <h4 class="mt-0">
                                <small>0 VND </small>
                            </h4>
                        </div>

                        <div class="mt-4">
                            <div class="btn btn-primary btn-lg btn-flat">
                                <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                Thêm vào giỏ hàng
                            </div>

                        </div>

                        <div class="mt-4 product-share">
                            <a href="#" class="text-gray">
                                <i class="fab fa-facebook-square fa-2x"></i>
                            </a>
                            <a href="#" class="text-gray">
                                <i class="fab fa-twitter-square fa-2x"></i>
                            </a>
                            <a href="#" class="text-gray">
                                <i class="fas fa-envelope-square fa-2x"></i>
                            </a>
                            <a href="#" class="text-gray">
                                <i class="fas fa-rss-square fa-2x"></i>
                            </a>
                        </div>

                    </div>
                </div>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->


    <!-- /.control-sidebar -->
<!-- ./wrapper -->


    {{-- <script>
        CKEDITOR.replace('inputDescription');
    </script> --}}

@endsection
