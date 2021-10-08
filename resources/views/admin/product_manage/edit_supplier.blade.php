@extends('layout.layout_admin')
@section('title','Đổi sản phẩm')

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
                        <li class="breadcrumb-item"><a href="{{ url('product-supplier') }}">Nhà Cung Cấp</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa nhà cung cấp</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection


@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <section class="col-lg-6 offset-lg-3">
                    <!-- TO DO List -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                CHỈNH SỬA SẢN PHẨM
                            </h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body p-2">
                            <form action="{{ url('update-supplier/'.$infor_supplier->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="">Tên nhà cung cấp:</label>
                                    <input type="text" name="inputName" class="form-control" placeholder="Nhập tên sản phẩm..."
                                    value="{{ $infor_supplier->supplier_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Địa Chỉ:</label>
                                    <input type="text" name="inputAddress" class="form-control" placeholder="Nhập tên sản phẩm..."
                                    value="{{ $infor_supplier->supplier_address }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Mô tả</label>
                                    <textarea class="form-control" name="inputDescribe"  rows="6" placeholder="Nhập mô tả...">{{ $infor_supplier->supplier_describe }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Hình ảnh: </label>
                                    <input type='file' name="inputFileImage">
                                    <img id="blah" src="{{ url('public/home/upload_img/'.$infor_supplier->supplier_img)}}" alt="Hình Ảnh" style="max-width:100%; height:80px; border: 2px solid #bdc3c7;"/>
                                </div>

                                <br>
                                <div class="form-group row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">Cập Nhật</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>

            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <script>
        CKEDITOR.replace('inputDescription');
    </script>

@endsection
