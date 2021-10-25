@extends('layout.layout')
@section('title','Trang giỏ hàng')
@section('content')
<link href="{{ asset('public/home/css/bootstrap.min.css') }}" rel="stylesheet">


<style>
        .image-product{
            max-width: 100px;
            height: auto;
            width: 100%;
            border-radius: 5px;
        }
        
        table {
            padding: 0;
            width: 100%;
            height: 100px;
            table-layout: auto;
        }
        table tr {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: .10em;
        }
        table th, table td{
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 15px;
        }
        table th {
            font-size: 12px;
            text-transform: uppercase;
            color: black;
            font-weight: bold;
        }
        tr:hover {background-color:#f5f5f5;}
        
        input[type="number"]{
            width: 50px;
        }
</style>

<section id="test">
    <div class="container">
     <div class="row">
        <div class="collection_text">
            Giỏ Hàng
        </div>
     </div> 
    </div>
</section>

    @if ($show_carts->count() > 0)
        <table class="table table-bordered" style="max-width: 60%; margin: auto; padding-bottom: 60px;">
            <thead>
            <tr>
                <th>Tên Sản Phẩm</th>
                <th>Hình Ảnh</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Tổng Tiền</th>
                <th scope="col" colspan="2">Tùy chọn</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($show_carts as $show_cart)
                    @php($get_products = DB::table('products')->where('id',$show_cart->product_id)->first())
                    <form action="{{ url('update-cart/'.Auth::id().'/'.$show_cart->id) }}" method="POST">
                        @csrf
                        <tr>
                            <td data-label="Tên sản phẩm">
                                <a href="#">{{ $get_products->product_name }}</a>
                            </td>
                            <td data-label="Hình Ảnh">
                                <a href="#">
                                    <img class="image-product" src="{{asset('public/home/upload_img/'.$get_products->product_img)}}" width="145" height="145" >
                                </a>
                            </td>
                            <td data-label="Giá">
                                {{  number_format($get_products->product_price) }} VND/{{ $get_products->unit_price }} 
                            </td>

                            <td data-label="Số lượng"> 
                                <input type="number" size="3" class="input-text qty text" name="quantity" value="{{ $show_cart->quantity }}" min="0" step="1">
                            </td>
    
                            <td data-label="Tổng tiền">
                                {{ number_format($get_products->product_price * $show_cart->quantity) }} VND
                            </td>
                            <td data-label="Tùy chọn">
                                <input type="submit" class="btn btn-success"  value="Cập Nhật"  name="update_cart">
                            </td>
                            <td data-label="Tùy chọn"> 
                                <a href="{{ url('delete-product-cart/'.$show_cart->id) }}" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc muốn xóa không?');">
                                    <i class="fa fa-recycle" aria-hidden="true"> Xóa</i>
                                </a>
                            </td>
                        </tr>  
                    </form>
                @endforeach
                        <tr>
                            <td colspan="6"></td>
                            <td class="actions" colspan="2" style="padding:10px;">
                                <a href="{{ url('page-checkout/'.Auth::id()) }}">
                                    <input type="submit" value="Thanh Toán"  class="btn btn-primary" >
                                </a>
                            </td>
                        </tr>
            </tbody>
        </table>
        <div style="margin-top: 40px;"></div>
    @else
        <div class="alert alert-danger text-center" role="alert">
            <strong style="font-size: 25px;"> Giỏ hàng không có sản phẩm!!!</strong>
        </div>
    @endif
    @if(session()->has('cart'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Đã xóa sản phẩm!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
  @endsection