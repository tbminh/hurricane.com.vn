@extends('layout.layout')
@section('title','Trang đăng nhập')
@section('content')
{{-- <link href="{{ asset('public/home/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
<style>
    html,body { 
	height: 80%; 
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
        font-size: 14px;
        margin-top: 30px;
    }
    .form-inline .form-control {
    display: inline-block;
    width: 400px;
    height: 40px;
    vertical-align: middle;    
    } */
    .card-title{ font-weight:300; }

    /* .btn{
        font-size: 14px;
        margin-top:20px;
    } */


    .login-form{ 
        width:330px;
        margin:20px;
    }

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
		<h3 class="card-title text-center">ĐĂNG NHẬP</h3>
		<div class="card-text">
			<!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
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
                    <a href="#" style="float:right;font-size:12px; margin: 5px 0;">Quên mật khẩu</a>
				</div>
				<button type="submit" class="btn btn-danger btn-block">Đăng Nhập</button>
				
				<div class="sign-up">
					Nếu bạn chưa có tài khoản? <a href="{{ url('page-sign-up') }}">Đăng ký ngay</a>
				</div>
			</form>
		</div>
	</div>
</div>
</div>
@if(session()->has('message2'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Tài khoản hoặc mật khẩu sai!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif 
    
<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
        alert(msg);
    }
</script>    
@endsection