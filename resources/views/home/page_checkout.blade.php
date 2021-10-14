
@extends('layout.layout')
@section('title','Trang thanh toán')
@section('content')
<link href="{{ asset('public/home/css/bootstrap.min.css') }}" rel="stylesheet">
<style>
    .collection_text{
        background: url(img/crossword.png) repeat scroll 0 0 #192A56;
        font-family: raleway;
        font-size: 50px;
        font-weight: 200;
        margin: 0;
        padding: 50px 0;color: #fff;
        text-align: center;
    }
    table thead tr th{
        text-align: center;
    }
    table tbody tr td{
        text-align: center;
        padding: 15px;
    }
    table tbody tr td .shop_thumbnail{
        width: 70px;
        height:60px;
    }
    table tbody tr td a,span{
        font-size: 15px;
    }
    table tfoot tr td{
        text-align: center;
    }
</style>

<section id="test" style="margin-bottom: 30px;">
    <div class="container">
     <div class="row">
      <div class="products_1">
       <h2 style="color: #B06565;">Thanh Toán</h2>
      </div>
     </div> 
    </div>
</section>

<div class="single-product-area">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div id="customer_details" class="col2-set">
                    <div class="col-1">
                        <div class="woocommerce-billing-fields"><br><br>
                            <h3><b>INFORMATION</b> </h3>
                            <label class="" for="billing_country">
                                <b style="font-size: 18px">
                                    <p>Họ Tên: {{ Auth::user()->full_name }}</p>
                                    <p>Điện Thoại: {{ Auth::user()->phone }}</p>
                                    <p>Email: {{ Auth::user()->email }}</p>
                                    <p>Địa chỉ: {{ Auth::user()->address }}</p>
                                    <a href="#" class="btn btn-danger">
                                        Thay đổi thông tin
                                    </a>
                                </b>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="product-content-right">
                    <div class="woocommerce">
                        <form action="{{ url('checkout-payment/'.Auth::id()) }}" class="checkout" method="post">
                            @csrf
                            <h3 id="order_review_heading"><br><br><b>RECEIPT</b> </h3>
                            <div id="order_review" style="position: relative;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th class="product-image">Hình ảnh</th>
                                            <th class="product-name">Tên sản phẩm</th>
                                            <th class="product-price">Giá</th>
                                            <th class="product-quality">Số lượng</th>
                                            <th class="product-total">Tổng</th>
                                        </tr>
                                    </thead>
                                    <?php $total_price = 0; ?>
                                    @foreach ($show_carts as $key => $data)
                                        @php($get_product = DB::table('products')->where('id', $data->product_id)->first())
                                        <tbody>
                                                <tr>
                                                    <td><span>{{ ++$key }}</span></td>
                                                    <td class="product-image">
                                                        <a href="#">
                                                            <img class="shop_thumbnail" src="{{asset('public/home/upload_img/'.$get_product->product_img)}}">
                                                        </a>
                                                    </td>

                                                    <td data-label="Tên sản phẩm">
                                                        <a href="#" style="color:#1abc9c">
                                                            {{ $get_product->product_name }}
                                                        </a>
                                                    </td>
                                                    <td data-label="Giá sản phẩm" >
                                                        <span class="amount" >{{ number_format($get_product->product_price) }} VND/{{ $get_product->unit_price }}</span>
                                                    </td>
                                                    <td data-label="Số lượng">
                                                        <span>{{ $data->quantity }}</span>
                                                    </td>
                                                    <td data-label="Tổng đơn hàng">
                                                        <?php
                                                            $price = $get_product->product_price;
                                                            $qty = $data->quantity;
                                                            $total = $price * $qty;
                                                            $total_price = $total_price + $total;
                                                        ?>
                                                        <span class="amount">{{ number_format($total) }} VND</span>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    @endforeach    
                                </table>
                                

                                <div class="row">
                                    <div class="col-md-4">
                                        <h3><b>PAYMOND METHOD</b> </h3>
                                    </div>
                                    <div class="col-md-8" style="margin-top: 20px">
                                        <select name="method" class="form-control" aria-label="Disabled select example" required>
                                            <option value="">--- Chọn Phương Thức Thanh Toán ---</option>
                                            <option value="1">Thanh toán khi nhận hàng</option>
                                            <option value="2">Thanh Toán online</option>
                                          </select>
                                    </div>
                                </div>
                                
                                
                                <table class="table table-bordered" style="width:100%; margin-top: 30px;" >
                                    <tfoot>
                                        <tr class="cart-subtotal">
                                            <td>
                                                <strong>Tổng phụ giỏ hàng</strong>
                                            </td>
                                            <td>
                                                <span>
                                                    {{ number_format($total_price) }} VND
                                                </span>
                                            </td>
                                        </tr>

                                        <tr class="shipping">
                                            <td>
                                                <strong>Vận chuyển và xử lí</strong>
                                            </td>
                                            <td>
                                                    <span>
                                                        Miễn phí vận chuyển trong khu vực
                                                    </span>
                                            </td>
                                        </tr>

                                        <tr class="order-total">
                                            <td>
                                                <strong>Tổng đơn hàng</strong>
                                            </td>

                                            <td data-label="Tổng đơn hàng">
                                                    <span class="amount">{{ number_format($total_price) }} VND</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td class="actions">
                                                    <input type="submit" value="Đặt hàng" class="btn btn-danger" name="update_cart">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
