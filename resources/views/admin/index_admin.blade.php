@extends('layout.layout_admin')
@section('title','Trang chủ quản trị')

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Bảng điều khiển</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection


@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>10</h3>
                            <p>Đơn hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ url('admin-order') }}" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>10<sup style="font-size: 20px"></sup></h3>

                            <p>Số sản phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>10</h3>

                            <p>Số khách hàng</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="10" class="small-box-footer">Xem thêm<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Tổng doanh thu</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">Xem thêm <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->


            <!-- Main row -->
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <!-- TO DO List -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                HÓA ĐƠN MỚI NHẤT
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Địa chỉ</th>
                                    <th>Trạng thái</th>
                                    <th>Phương thức thanh toán</th>
                                    <th scope="col" colspan="2">Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>test</td>
                                        <td>test</td>
                                        <td>test</td>
                                        <td>test</td>
                                        <td>test</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm" type="button" >
                                                <i class="fa fa-check-circle"></i> Duyệt
                                            </button>
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="#" role="button" >
                                                <i class="fas fa-eye"></i> Xem
                                            </a>
                                        </td>
                                    </tr>
                                {{-- @foreach($show_order_lastests as $key => $data)
                                    @php($get_user = DB::table('users')->where('id',$data ->user_id)->first())
                                        <tr>
                                            <td> {{ ++$key }} </td>
                                            <td>{{ '000'.$data-> id }}</td>

                                            <td>{{$get_user->full_name }}</td>

                                            <td>
                                                {{ $get_user->adress }}
                                            </td>

                                            <td>
                                                @if ($data->order_status == 0 )
                                                    <b style="color:blue;"> Chờ thanh toán </b>
                                                @elseif($data->order_status == 1)
                                                    <b style="color:green;"> Đang giao hàng </b>
                                                @else
                                                    <b style="color:red;">Đã hủy</b>
                                                @endif
                                            </td>

                                            <td>{{ $data->order_amount}}</td>

                                            <td>
                                                @if ($data->order_status ==2 )
                                                    <button class="btn btn-danger btn-sm" type="button" disabled>
                                                        <i class="fa fa-check-circle"></i> Duyệt
                                                    </button>
                                                @elseif($data->order_status ==1)
                                                    <a class="btn btn-danger btn-sm" href="{{ url('cancel-order/'.$data->id) }}" role="button">
                                                        <i class="fa fa-recycle"></i> &nbsp; Hủy
                                                    </a>
                                                @else
                                                    <a class="btn btn-primary btn-sm" href="{{ url('approve-order/'.$data->id) }}" role="button">
                                                        <i class="fa fa-check-circle"></i> Duyệt
                                                    </a>
                                                @endif
                                            </td>

                                            <td>
                                                <a class="btn btn-success btn-xs" href="{{ url('admin-order-detail/'.$data->id) }}" role="button" >
                                                    <i class="fas fa-eye"></i> Xem
                                                </a>
                                            </td>
                                        </tr>
                                @endforeach --}}
                                </tbody>
                            </table>
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
@endsection