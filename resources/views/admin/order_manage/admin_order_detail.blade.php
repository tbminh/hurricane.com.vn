@extends('layout.layout_admin')
@section('title', 'Trang hóa đơn chi tiết')


@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('page-admin')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('admin-order') }}">Hóa đơn</a></li>
                        <li class="breadcrumb-item active">Hóa đơn chi tiết</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                Ngày đặt hàng:
                <strong>{{ $show_order->created_at }}</strong>
                <span class="float-right"> <strong>Trạng thái:</strong> Đang giao hàng</span>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong style="color: #D96B5F;">HURRICANE.COM.VN</strong>
                        </div>
                        <div>Địa Chỉ: Ninh Kiểu, Cần Thơ</div>
                        <div>Email: hurricane.chicken@gmail.com</div>
                        <div>Phone: +84 899 068 414</div>
                    </div>

                    <div class="col-sm-6">
                        <h6 class="mb-3">To:</h6>
                        @php($show_user = DB::table('users')->where('id',$show_order-> user_id)->first())
                        <div>
                            <strong>Họ Tên: {{ $show_user->full_name }}</strong>
                        </div>
                        <div>Địa Chỉ: {{ $show_user->address}}</div>
                        <div>Email: {{$show_user->email }}</div>
                        <div>Liên Lạc: 0{{$show_user->phone }}</div>
                    </div>
                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="center">Stt</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Giá bán</th>
                            <th class="right">Số lượng</th>
                            <th class="right">Tổng tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $total_price = 0; ?>
                        @php($get_details = DB::table('order_details')->where('order_id', $show_order->id)->get())
                        @foreach($get_details as $key =>$data)
                            <tr>
                                <td class="center">{{ ++$key }} </td>
                                @php($get_product = DB::table('products')->where('id', $data->product_id)->first())
                                <td class="left strong">{{$get_product->    product_name}}</td>
                                <td class="center"><img src="{{ url('public/home/upload_img/'.$get_product->product_img) }}" class="img-circle elevation-2" alt="User Image " width="30px" height="30px"></td>
                                <td class="left">{{ number_format($get_product->product_price)}} VND</td>
                                <td class="right">{{ $data->total_quantity }}</td>
                                <td class="right">
                                    <?php
                                    $price = $get_product->product_price;
                                    $qty = $data ->total_quantity;
                                    $total = $price * $qty;
                                    $total_price = $total_price + $total;
                                    ?>
                                    <span class="amount">{{ number_format($total_price) }} VND</span>
                                 </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                            <tr class="shipping">
                                <td class="left">
                                    <strong>Phí vận chuyển</strong>
                                </td>

                                <td>
                                    @if ($total_price >= 1000000)
                                        <?php  $delivery =0; ?>
                                        <b>Miễn phí vận chuyển</b>
                                        <input type="hidden" value="0" name="inputDelivery">
                                    @else
                                        <b><?php $delivery = 100000; echo number_format($delivery); ?> VND</b>
                                        <input type="hidden" value="{{ $delivery }}" name="inputDelivery">
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="left">
                                    <strong>Tổng tiền thanh toán</strong>
                                </td>

                                <td class="right">
                                    <?php $total_payment = $total_price + $delivery ?>
                                    <strong>{{ number_format($total_payment) }} VND</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="card-tools text-right">
                            <a class="btn btn-primary btn-sm" href="{{ url('export-order/'.$show_order->id) }}" role="button">
                                <i class="fa fa-plus-circle"></i> Xuất hóa đơn
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
