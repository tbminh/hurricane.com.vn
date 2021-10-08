@extends('layout.layout_admin')
@section('title', 'Trang nhân viên')


@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="page-admin">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Nhân viên</li>
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
{{--                Hiển thị dòng thông báo đã thêm thành công--}}
                @if(session()->has('message1'))
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Đã thêm thành công nhân viên mới!',
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
                            Nhân viên
                        </h3>

                            <div class="card-tools">
                                <a class="btn btn-primary btn-sm" href="{{ url('page-add-admin') }}" role="button" >
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
                                <th>Họ và tên</th>
                                <th>Tài khoản</th>
                                <th>Hình ảnh</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Điện thoại</th>
                                <th>Giới tính</th>
                                <th scope="col" colspan="2">Tùy chọn</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($show_employee as $key => $data)
                            <tr>
                                <td> {{ ++$key }}</td>
                                <td>{{$data->full_name}}</td>
                                <td>{{$data->user_name}}</td>
                                <td>
                                    <img src="{{ url('public/home/upload_img/'.$data->avatar) }}"
                                        class="img-circle elevation-2" alt="User Image " width="30px" height="30px">
                                </td>
                                <td>{{$data->email}}</td>
                                <td>{{$data->address}}</td>
                                <td>0{{$data->phone}}</td>
                                <td>
                                    @if ($data->gender==0)
                                        <b>Nam</b> 
                                    @elseif($data->gender==1)
                                        <b>Nữ</b>
                                    @else   <b>Khác</b>        
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-danger btn-xs"
                                    href="{{ url('delete-employee/'.$data->id) }}" role="button" onclick="return confirm('Bạn có chắc muốn xóa không?')">
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-success btn-xs" href="{{ url('page-change-role/'.$data->id) }}" role="button">
                                        <i class="fas fa-exchange-alt"></i> Đổi
                                    </a>
                                </td>
                            </tr>

                            @empty
                                <tr>
                                    <td colspan="11">
                                        <b class="text-danger">Không có dữ liệu </b>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <ul class="pagination justify-content-center" style="margin:20px 0">
                            {{ $show_employee->links() }}
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

@endsection

