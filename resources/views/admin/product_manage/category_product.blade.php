@extends('layout.layout_admin')
@section('title','Trang loại sản phẩm')

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
                        <li class="breadcrumb-item active">Loại sản phẩm</li>
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
                <section class="col-lg-6 connectedSortable">
                    {{-- Hiển thị thông báo đã thêm loại sp mới --}}
                    @if(session()->has('message1'))
                        <script>
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Đã thêm sản phẩm mới!',
                                showConfirmButton: false,
                                timer: 2000
                            })
                        </script>
                    @endif
                        {{-- Đã xóa sản phẩm --}}
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
                                THÊM LOẠI
                            </h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body p-3">
                            <form action="{{ url('post-add-category') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-3">
                                        <label for="">Tên loại:</label>
                                    </div>

                                    <div class="col-9">
                                        <input type="text" name="inputCategory" class="form-control" placeholder="Nhập tên loại">
                                        <small class="text-danger">{{ $errors->first('inputCategory') }}</small>
                                    </div>

                                    <div class="col-3">
                                        <label for="">Hình ảnh:</label>
                                        <input type="file" class="form-control-file" id="imgInp" name="inputFileImage">
                                        <img id="blah" src="#" style="max-width:100%;height:50px;border-radius:5px;"/>
                                    </div>

                                </div>

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


                <section class="col-lg-6 connectedSortable">
                    <!-- TO DO List -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                LOẠI SẢN PHẨM
                            </h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body p-1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên loại</th>
                                    <th>Hình ảnh</th>
                                    <th scope="col" colspan="2">Tùy chọn</th>
                                </tr>
                                </thead>

                                <tbody>

                                @forelse($show_categories as $key => $data)
                                <tr>
                                    <td> {{ ++$key }}</td>
                                    <td> {{$data->category_name}}</td>
                                    <td>
                                        <img src="{{ url('public/home/upload_img/'.$data->category_image) }}"
                                             class="img-circle elevation-2" alt="Category Image " width="30px" height="30px">
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="{{ url('edit-category/'.$data->id) }}" role="button">
                                            <i class="fas fa-edit"></i> Đổi
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-xs"
                                           href="{{ url('delete-category/'.$data->id) }}" role="button" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                            <i class="fa fa-trash"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="10">
                                            <b class="text-danger">Không có dữ liệu </b>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                            <ul class="pagination justify-content-xl-end" style="margin:20px 0">
                                {{ $show_categories->links() }}
                            </ul>

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
        CKEDITOR.replace( 'inputDescript' );
    </script>

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
