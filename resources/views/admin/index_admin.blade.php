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
                            @php($count_order = DB::table('orders')->where('order_status',0)->count())
                            <h3>{{ $count_order }}</h3>
                            <p>Đơn chưa duyệt</p>
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
                            @php($count_product = DB::table('products')->count())
                            <h3>{{ $count_product }}</h3>

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
                            @php($count_client = DB::table('users')->where('role_id',3)->count())
                            <h3>{{ $count_client }}</h3>

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
                            @php($get_total = DB::table('order_details')->sum('total_price'))
                            <h3>{{ number_format($get_total) }}</h3>

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
                                    <th scope="col" colspan="3">Tùy chọn</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($show_order_lastests as $key => $data)
                                        @php($get_user = DB::table('users')->where('id',$data ->user_id)->first())
                                        <tr>
                                            <td> {{ ++$key }} </td>
                                            <td>{{ '000'.$data-> id }}</td>

                                            <td>{{$get_user->full_name }}</td>

                                            <td>
                                                {{ $get_user->address }}
                                            </td>

                                            <td>
                                                <b style="color:blue;"> Chờ thanh toán </b>
                                            </td>

                                            <td>
                                                @if ($data->order_payment == 1)
                                                    <b style="color: #d35400;">
                                                        <i class="fa fa-money" aria-hidden="true"></i>&nbsp; Thanh Toán Tiền Mặt 
                                                    </b> 
                                                @else
                                                    <b style="color: #22a6b3;">
                                                        <i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp; Thanh Toán Online 
                                                    </b>  
                                                @endif
                                            </td>

                                            <td>
                                                <a class="btn btn-primary btn-sm" href="{{ url('approve-order/'.$data->id) }}" role="button">
                                                    <i class="fa fa-check-circle"></i> Duyệt
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger btn-sm" href="{{ url('cancel-order/'.$data->id) }}" role="button" onclick="return confirm('Bạn có muốn hủy đơn hàng không ?');">
                                                    <i class="fa fa-recycle"></i> &nbsp; Hủy
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-success btn-sm" href="{{ url('admin-order-detail/'.$data->id) }}" role="button" >
                                                    <i class="fas fa-eye"></i> Xem
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                        <div class="alert alert-danger text-center" role="alert">
                                            <strong style="font-size: 25px;"> Không có đơn hàng</strong>
                                        </div>
                                    @endforelse
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