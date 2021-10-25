    {{-- Bootstrap 4 --}}
{{-- <link href="{{ asset('public/home/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
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
    li a, .dropbtn {
    display: inline-block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    }

    li.dropdown {
    display: inline-block;
    }

    .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    }

    .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
    }

    .dropdown-content a:hover {background-color: #f1f1f1;}

    .dropdown:hover .dropdown-content {
    display: block;
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
                        {{-- <li class="dropdown">
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
                        </li> --}}
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropbtn">
                                <i class="fa fa-user"></i> {{(Auth::user()->user_name)}}
                            </a>
                            <div class="dropdown-content">
                                <a href="{{ url('page-profile') }}">
                                    <i class="fa fa-user fa-fw"></i>Thông Tin Cá Nhân
                                </a>
                                <a href="{{ url('page-complete/'.Auth::id()) }}"><i class="fa fa-cutlery fa-fw">
                                    </i>Đơn Hàng
                                </a>
                                <a href="{{ url('logout') }}" onclick="return confirm('Bạn có muốn đăng xuất không ?')">
                                    <i class="fa fa-sign-out fa-fw"></i>Đăng Xuất
                                </a>
                            </div>
                          </li>
                    @else
                        <li><a href="#" type="button"  data-toggle="modal" data-target="#exampleModalSignUp">
                            <i class="fa fa-sign-in"></i> Đăng ký</a>
                        </li>
                        <li><a href="#" type="button"  data-toggle="modal" data-target="#exampleModalSignIn">
                            <i class="fa fa-sign-in"></i> Đăng nhập</a>
                        </li>
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
<!-- Modal đăng nhập -->
<div class="modal fade" id="exampleModalSignIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          {{-- Content modal --}}
            {{-- <div class="card login-form"> --}}
                <div class="card-body">
                    <h3 class="card-title text-center">ĐĂNG NHẬP</h3>
                    <div class="card-text">
                        <form action="{{ url('post-login') }}" method="post">
                            @csrf
                            <!-- to error: add class "has-danger" -->
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên đăng nhập</label>
                                <input type="text" class="form-control form-control-sm" name="user_name" placeholder="Nhập tên...">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mật Khẩu</label>
                                <input type="password" class="form-control form-control-sm" name="password" placeholder="Nhập mật khẩu...">
                                <a href="#" style="float:right; font-size:15px; margin: 10px 0;">Quên mật khẩu!!!</a>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block">Đăng Nhập</button>
                        </form>
                    </div>
                </div>
            {{-- </div> --}}
      </div>
    </div>
  </div>
<!-- Modal đăng ký -->
<div class="modal fade" id="exampleModalSignUp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
          {{-- Content modal --}}
          <div class="card-body">
            <h2 class="card-title text-center">ĐĂNG KÝ</h2>
            <div class="card-text">
                <!--
                <div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
                <form class="login-form" action="{{ url('post-sign-up') }}" method="post">
                    @csrf
                    <!-- to error: add class "has-danger" -->
                    <div class="form-group">
                        <label for="exampleInputEmail1">Họ Tên</label>
                        <input type="text" class="form-control form-control-sm" name="full_name" placeholder="Nhập họ tên...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tài Khoản</label>
                        <input type="text" class="form-control form-control-sm" name="user_name" placeholder="Nhập tên tài khoản...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật Khẩu</label>
                        <input type="password" class="form-control form-control-sm" name="password" placeholder="Nhập mật khẩu...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Xác Nhận Mật Khẩu</label>
                        <input type="password" class="form-control form-control-sm" name="confirm" placeholder="Xác nhận mật khẩu...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" class="form-control form-control-sm" name="email" placeholder="Nhập email...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Địa Chỉ</label>
                        <input type="text" class="form-control form-control-sm" name="address" placeholder="Nhập địa chỉ...">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số Điện Thoại</label>
                        <input type="number" class="form-control form-control-sm" name="phone" placeholder="Nhập số...">
                    </div>
                    <button type="submit" class="btn btn-danger btn-block">Đăng Ký</button>
                    
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
    $(document).ready(function() {
    $(".dropdown-toggle").dropdown();
});
</script>