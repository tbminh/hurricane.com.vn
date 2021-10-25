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
                        <li class="breadcrumb-item"><a href="{{ url('page-list-product') }}">Sản phẩm</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa sản phẩm</li>
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
                            <form action="{{ url('update-product/'.$infor_product->id.'/'.$get_ps->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label for="">Tên sản phẩm:</label>
                                    <input type="text" name="inputName" class="form-control" placeholder="Nhập tên sản phẩm..."
                                    value="{{ $infor_product->product_name }}">
                                </div>

                                <div class="form-group">
                                    <label for="">Nhà cung cấp:</label>
                                    <select name="inputSupplier" class="form-control">
                                        @php($supplier = DB::table('suppliers')->where('id',$get_ps->supplier_id)->first())
                                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                        <option value=""> --Chọn--</option>
                                        @php($get_suppliers = DB::table('suppliers')->get())
                                        @foreach($get_suppliers as $value)
                                            <option value="{{ $value->id }}">
                                                {{$value->supplier_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Hình ảnh: </label>
                                    <input type='file' name="inputFileImage">
                                    <img id="blah" src="{{ url('public/home/upload_img/'.$infor_product->product_img)}}" title="{{ $infor_product->product_name }}" alt="Hình Ảnh" style="max-width:100%; height:80px; border: 2px solid #bdc3c7;"/>
                                </div>

                                <div class="form-group col-md-10">
                                    <label for="">Giá sản phẩm:</label>
                                    <input type="number" name="inputPrice" class="form-control" placeholder="Nhập giá sản phẩm..."
                                    value="{{ ($infor_product->product_price) }}">
                                </div>

                                <div class="form-group col-md-10">
                                    <label for="">Số lượng:</label>
                                    <input type="number" name="inputQuantity" class="form-control" placeholder="Nhập số lượng..."
                                     value="{{ $infor_product->product_quantity }}">
                                </div>

                                <div class="form-group col-md-10">
                                    <label for="">Đơn vị tính:</label>
                                    <input type="text" name="inputUnit" class="form-control" placeholder="Nhập đơn vị tính..."
                                    value="{{ $infor_product->unit_price }}">
                                </div>

                                <div class="form-group col-md-10">
                                    <label for="">Giảm giá (%):</label>
                                    <input type="number" name="inputDiscount" class="form-control" placeholder="Nhập giá chiết khấu..."
                                    value="{{ $infor_product->product_discount }}">
                                </div>


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
