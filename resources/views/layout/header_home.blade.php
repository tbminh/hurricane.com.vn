    {{-- Bootstrap 4 --}}
{{-- {{-- <link href="{{ asset('public/home/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
<script src="{{ asset('public/home/js/bootstrap.min.js') }}"></script> 
{{-- Jquery --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<style type="text/css" media="screen">
    #search{
        margin-top: 25px !important;
    }
    .shopping-item {
    border: 1px solid #ddd;
    float: right;
    font-size: 20px;
    margin-top: 22px;
    padding: 10px;
    position: relative;
    }
    .shopping-item:hover{
        background-color: #c51c0a;
        color: #fff;
    }
    .shopping-item a {
        color: #666;
        text-decoration: none;
    }
    .shopping-item a:hover{
        color: #fff;
    }
    .product-count {
    background: none repeat scroll 0 0 #c51c0a;
    border-radius: 50%;
    color: #fff;
    display: inline-block;
    font-size: 11px;
    height: 20px;
    padding-top: 2px;
    position: absolute;
    right: -10px;
    text-align: center;
    top: -10px;
    width: 20px;
    }
    
    .shopping-item:hover .product-count {
    background: none repeat scroll 0 0 #000;
    }
    @media screen and (max-width: 600px) {
        .shopping-item {
            display: none;
        }
        .form-seach{
            display: none;
        }
        .navbar-form .input-group .input-group-btn button{
            height: 34px;
        }
        .col-sm-12 .form-search-mobile{
            display: inline-block;
        }
        .row #cart-mobile{
            display: inline-block;
        }
        }
        .row .col-md-6 .form-seach #input-search{
            width: 400px !important;
        }
        .form-search-mobile{
            display: none;
        }
        #cart-mobile{
            display: none;
        }
        .form-inline .form-control {
        display: inline-block;
        width: 400px;
        height: 40px;
        vertical-align: middle;
        }
        .form-inline .btn{
        background-color: #EB2F06;
            height: 40px;
        } 
        .form-inline .btn:hover{
            background-color: #b33939;
        }
</style>

<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    @if (Auth::check())
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-user"></i> {{(Auth::user()->user_name)}}
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="{{ url('page-profile') }}"><i class="fa fa-user fa-fw"></i>Thông Tin Cá Nhân</a>
                                </li>
                                <li><a href="{{ url('page-complete/'.Auth::id()) }}"><i class="fa fa-cutlery fa-fw"></i>Đơn Hàng</a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="{{ url('logout') }}" onclick="return confirm('Bạn có muốn đăng xuất không ?')">
                                        <i class="fa fa-sign-out fa-fw"></i>Đăng Xuất
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ url('page-sign-up') }}"><i class="fa fa-check"></i> Đăng ký</a></li>
                        <li><a href="{{url('page-login')}}"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div> <!-- End header area -->

<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="logo">
                <h1>
                    <a href="{{ url('/') }}">
                        <img src="{{ url('public/home/upload_img/logo2.png') }}" style="max-width: 100%;height:60px;">
                    </a>
                </h1>
            </div>
        </div>
        
        <div id="search" class="col-sm-6 col-md-6">
            <nav class="navbar navbar-expand-sm navbar-dark">
                <form class="form-inline" action="{{ url('page-product') }}" method="get"> 
                  <input class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm sản phẩm...">
                  <button id="btn-search" class="btn btn-danger" type="submit" >Search</button>
                </form>
              </nav>
        </div>

        <div class="col-sm-3">
            <div class="shopping-item">
                @if(Auth::check())
                        <a href="{{ url('page-cart/'.Auth::id()) }}" >
                            Giỏ Hàng<i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span class="product-count">
                                @php($count_cart = DB::table('shopping_carts')->where('user_id', Auth::id())->count())
                                    {{ $count_cart }}
                            </span>
                        </a>
                @else
                        <a onclick="return nonlogin('Bạn cần đăng nhập trước !!')" href="{{ url('page-login') }}">
                            Giỏ Hàng <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            <span class="product-count">0</span>
                        </a>	
                @endif
            </div>
        </div>
    </div>
</div>

</section>