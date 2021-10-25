@extends('layout.layout')
@section('title','Trang đăng ký')
@section('content')
<style>
    html,body { 
	height: 100%; 
    }
    .global-container{
        height:100%;
        min-width: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f5f5f5;
    }
    /* form{
        padding-top: 10px;
        font-size: 15px;
        margin-top: 30px;
    } */

    .card-title{ font-weight:300; }

    /* .btn{
        font-size: 14px;
        margin-top:20px;
    }


    .login-form{ 
        width:500px;
        margin:20px;
    } */

    .sign-up{
        text-align:center;
        padding:20px 0 0;
    }

    .alert{
        margin-bottom:-30px;
        font-size: 13px;
        margin-top:20px;
    }
</style>

<div class="global-container">
	<div class="card login-form">
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
				
				<div class="sign-up">
					Nếu bạn đã có tài khoản? <a href="{{ url('page-sign-up') }}">Nhập ký ngay</a>
				</div>
			</form>
		</div>
	</div>
</div>
</div>


@endsection