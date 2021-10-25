@extends('layout.layout_admin')
@section('title', 'Trang danh sách combo')


@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('page-admin')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách combo</li>
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
    {{--        Hiển thị dòng thông báo đã thêm thành công--}}
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
                            COMBO
                        </h3>
                        <div class="card-tools">
                            <button role="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModal" >
                                <i class="fa fa-plus-circle"></i> Thêm Combo
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-1">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Combo</th>
                                <th>Hình Ảnh</th>
                                <th>Tổng Giá</th>
                                <th>Giảm Giá</th>
                                <th scope="col" colspan="2">Tùy chọn</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($show_combos as $key => $data)
                                <tr>
                                    <td> {{ ++$key }}</td>

                                    <td>{{$data->combo_name}}</td>
                                    <td>
                                        <img src="{{ url('public/home/upload_img/'.$data->combo_img) }}"
                                            class="img-circle elevation-2" alt="Combo Image " width="50px" height="40px">
                                    </td>
                                    <td>{{number_format($data->combo_total_price)}} VND/Combo</td>
                                    <td>
                                        <input type="number" value="{{$data->combo_discount}}" name="inputDiscount"  style="width: 50px; height:30px; text-align: center;">
                                    </td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" href="#" role="button" onclick="return confirm('Bạn có chắc muốn xóa không?');">
                                            <i class="fa fa-trash"></i> Xóa
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{ url('combo-detail/'.$data->id) }}" >
                                            <i class="fas fa-eye"></i> Xem
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <ul class="pagination justify-content-xl-end" style="margin:20px 0">
                            {{ $show_combos->links() }}
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Thêm combo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('add-combo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên combo</label>
                        <input type="text" name="inputName" class="form-control" placeholder="Nhập tên sản phẩm" required>
                    </div>

                    <div class="form-group">
                        <label for="">Giảm giá</label>
                        <input type="number" name="inputDiscount" class="form-control" placeholder="Nhập tỷ lệ...">
                    </div>

                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control-file" id="imgInp" name="inputFileImage">
                        <img id="blah" src="#" style="max-width:100%;height:50px;border-radius:5px;"/>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary btn-sm">Thêm</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>

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

