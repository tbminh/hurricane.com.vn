@extends('layout.layout')
@section('title','Trang món ăn')
@section('content')
<link href="{{ asset('public/home/css/bootstrap.min.css') }}" rel="stylesheet">
<style>
    /* .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    } */
    .product-list .items{
        display: flex;
        padding: 0;
        flex-wrap: wrap;
    }
    .product-list .content{
        background: #fff;
        text-align: center;
        width: 100%;
    }
    .product-list .content .pro{
        margin-bottom: 20px;
    }
    /* .product-list .content .pro:hover{
        border: 1px solid #d0d0d0;
    } */
    .product-list .content .pro h3{
        text-transform: none;
        font-weight: 700;
        margin-bottom: 7px;
        overflow: hidden;
        font-size: 20px;
    }
    .product-list .content .pro h3 a{
        color: #0e0e0e;
        text-decoration: none;
    }
    .product-list .content .pro h3 a:hover{
        color: #d50000;
    }
    .product-list .content .pro .field-price{
        font-size: 20px;
        color: #d50000;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .product-list .content .pro .field-btn{
        font-weight: 700;
        padding: 9px 5px;
        background: #ffd800;
        border-radius: 5px;
        display: block;
        width: 186px;
        margin: 0 auto;
        text-transform: none;
    }
    .product-list .content .pro .field-btn a{
        color: #0e0e0e;
    }
    .product-list .content .pro .field-img .img-status {
    position: absolute;
    z-index: 1;
    right: -8px;
    top: -11px;
    }

    .product-list .content .pro .field-img .img-new {
    position: absolute;
    z-index: 1;
    right: 7px;
    top: -8px;
    }
    .product-list .list-menu{
        top: 30px;
        position: absolute;
        bottom: auto;
        background: linear-gradient(49.07deg,#f9c167 -16.39%,#ff304c 90%);
        border-radius: 0 5px 5px 0;
        list-style: none;
        margin-bottom: 0;
        left: 0;
        z-index: 3;
    }
    
</style>

<section id="test">
    <div class="container">
     <div class="row">
      <div class="products_1">
       <h2 style="color: #B06565;">{{ $category_id->category_name }}</h2>
      </div>
     </div> 
    </div>
</section>

<div class="container" style="min-height: 408px; margin-top: 50px;">
    <div class="product-list">
        <ul class="items">
            <li>
                <div class="content">
                    @foreach ($show_products as $show_product)
                        <div class="col-md-3">
                            <div class="pro">
                                <div class="field-img">
                                    @if($show_product->product_status == 1)
                                        <div class="img-status">
                                            <img src="{{ asset('public/home/upload_img/best.gif')}}">
                                        </div>
                                    @elseif($show_product->product_status == 2)  
                                        <div class="img-new">
                                            <img src="{{ asset('public/home/upload_img/new.gif')}}" width="80" height="60">
                                        </div>
                                     @endif    
                                    <a href="#"><img src="{{ asset('public/home/upload_img/'.$show_product->product_img) }}" width="236" height="165"></a>
                                </div>
                                <h3>
                                    <a href="#">{{ $show_product->product_name }}</a>
                                </h3>
                                <div class="field-price">
                                    <span>{{ number_format($show_product->product_price)  }}₫/{{ $show_product->unit_price }}</span>
                                </div>
                                <div class="field-btn">
                                    {{-- @if (Auth::check()) --}}
                                        <a href="{{ url('add-table-cart/'.$show_product->id.'/'.$id) }}">
                                            <i class="fa fa-shopping-cart"></i> Thêm Món
                                        </a>
                                    {{-- @else
                                        <a onclick="return nonlogin('Bạn cần đăng nhập trước !!')" href="{{ url('page-login') }}">
                                            <i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
                                        </a>
                                    @endif --}}
                                
                                </div>
                            </div>
                        </div>   
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
</div>
@if(session()->has('message'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Đã thêm món thành công!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
@endif

{{-- <script>
	function nonlogin(msg){
		if(window.confirm(msg)){
			return true;
		}
		return false;
	}
</script> --}}
@endsection