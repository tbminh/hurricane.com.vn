@extends('layout.layout_admin')
@section('title','Thêm chi tiết sản phẩm')

@section('link_css')

    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
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
                        <li class="breadcrumb-item active">Thêm sản phẩm</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection


@section('content')
@if()
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
                                THÊM SẢN PHẨM
                            </h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body p-2">
                            <form action="{{ url('post-product') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label for="">Tên sản phẩm</label>
                                    <input type="text" name="inputName" class="form-control" placeholder="Nhập tên sản phẩm">
                                    <div class="invalid-feedback">Chưa nhập tên sản phẩm </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Loại sản phẩm</label>
                                    <select name="inputCategoryId" class="form-control">
                                        <option value=""> --Chọn--</option>
                                        @php($get_categories = DB::table('categories')->get())
                                        @foreach($get_categories as $value)
                                            <option value="{{ $value->id }}">
                                                {{$value->category_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Số lượng</label>
                                    <input type="number" name="inputQuantity" class="form-control" placeholder="Nhập số lượng">
                                </div>

                                <div class="form-group">
                                    <label for="">Giá sản phẩm</label>
                                    <input type="number" name="inputPrice" class="form-control" placeholder="Nhập giá sản phẩm">
                                </div>


                                <div class="form-group">
                                    <label for="">Hình ảnh</label>
                                    <input type="file" class="form-control-file" id="imgInp" name="inputFileImage">
                                    <img id="blah" src="#" style="max-width:100%;height:50px;border-radius:5px;"/>
                                </div>

                                <div class="form-group">
                                    <label for="">Giảm giá</label>
                                    <input type="number" name="discount" class="form-control" placeholder="Nhập giảm giá...">
                                </div>

                                <div class="form-group">
                                    <label for="">Đơn vị tính</label>
                                    <input type="text" name="inputUnitPrice" class="form-control" placeholder="Nhập đơn vị tính">
                                </div>
                                

                                {{-- <div class="form-group">
                                    <label for="">Nhà cung cấp</label>
                                    <select name="inputSupplierId" class="form-control">
                                        <option value=""> --Chọn--</option>
                                        @php($get_suppliers = DB::table('suppliers')->get())
                                        @foreach($get_suppliers as $value)
                                            <option value="{{ $value->id }}">
                                                {{$value->supplier_name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="form-group row">
                                    <div class="col-12 text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">Thêm</button>
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
@endif

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#imgInp").change(function() {
            readURL(this);
        });
    </script>

@endsection
