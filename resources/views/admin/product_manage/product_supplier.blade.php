@extends('layout.layout_admin')
@section('title', 'Trang nhà cung cấp sản phẩm')


@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="page-admin">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Nhà cung cấp</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection


@section('content')
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                {{-- Hiển thị thông báo --}}
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                <!-- TO DO List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            NHÀ CUNG CẤP
                        </h3>
                        <div class="card-tools">
                            <a class="btn btn-primary btn-sm" href="#" role="button" data-toggle="modal" data-target="#modelId">
                                <i class="fa fa-plus-circle"></i> Thêm mới
                            </a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-1">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Địa chỉ cung cấp</th>
                                <th>Mô tả</th>
                                <th>Hình ảnh</th>
                                <th colspan="2">Tùy chọn</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($show_suppliers as $key => $data)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{$data->supplier_name}}</td>
                                <td>{{$data->supplier_address}}</td>
                                <td>{{$data->supplier_describe}}</td>

                                <td>
                                    <img src="{{ url('public/home/upload_img/'.$data->supplier_img)}}"
                                         class="img-circle elevation-2" alt="Product Image" width="30px" height="30px">
                                </td>

                                <td>
                                    <a class="btn btn-danger btn-sm" href="{{url('delete-supplier/'.$data->id) }}" role="button" onclick="return confirm('Bạn có chắc muốn xóa không?');">
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                </td>


                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('edit-supplier/'.$data->id) }}" role="button">
                                        <i class="fas fa-edit"></i> Đổi
                                    </a>
                                </td>

                            </tr>
                                @empty
                                    <tr>
                                        <td>
                                        <td colspan="11">
                                            <b class="text-danger">Không có dữ liệu </b>
                                        </td>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->

    </section>


    <!-- Modal thêm nhà cung cấp -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ url('post-supplier') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">THÊM NHÀ CUNG CẤP </h5>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Tên nhà cung cấp</label>
                            <input type="text" name="inputName" class="form-control" placeholder="Nhập họ và tên">
                            <small class="text-danger">{{ $errors->first('inputName') }}</small>
                        </div>

                        <div class="form-group">
                            <label for="">Địa chỉ</label>
                            <input type="name" name="inputAddress" class="form-control" placeholder="Nhập địa chỉ">
                        </div>

                        <div class="form-group">
                            <label for="">Mô tả</label>
                            <textarea class="form-control" name="inputDescribe" id="" rows="6" placeholder="Nhập mô tả"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="">Hình ảnh</label>
                            <input type="file" class="form-control-file" id="imgInp" name="inputFileImage">
                            <img id="blah" src="#" style="max-width:100%;height:50px;border-radius:5px;"/>
                        </div>

                        <div class="form-group ">
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-primary btn-sm">Thêm</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    @if(session()->has('message1'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Đã thêm nhà cung cấp mới!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
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

