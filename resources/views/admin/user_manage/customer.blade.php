@extends('layout.layout_admin')
@section('title', 'Trang khách hàng')


@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Khách hàng</li>
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
                        title: 'Đã thêm thành công khách hàng mới!',
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
                            Khách Hàng
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
                                <th>Giới tính</th>
                                <th>Số điện thoại</th>
                                <th>Email</th>
                                <th>Địa chỉ</th>
                                <th>Tùy chọn</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($show_customer as $key =>$data )
                                    <tr>
                                        <td scope="row">{{ ++$key }}</td>
                                        <td>{{ $data->full_name }}</td>
                                        <td>{{ $data->user_name }}</td>
                                        <td>
                                            <img src="{{ url('public/home/upload_img/'.$data->avatar) }}"
                                                class="img-circle elevation-2" alt="User Image " width="30px" height="30px">
                                        </td>
                                        <td>
                                            @if($data->gender ==0)
                                                <b>Nam</b>
                                            @elseif($data->gender)
                                                <b>Nữ</b> 
                                            @else 
                                                <b>Khác*</b>       
                                            @endif
                                        </td>
                                        <td>0{{ $data->phone }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->address }}</td>
                                        <td>
                                            <a class="btn btn-danger btn-xs" href="{{ url('delete-customer/'.$data->id) }}" role="button" onclick="return confirm('Bạn có chắc chắn không?');">
                                                <i class="fa fa-trash"></i> Xóa
                                            </a>
                                        </td>
                                    </tr>
                            @endforeach
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
@endsection
