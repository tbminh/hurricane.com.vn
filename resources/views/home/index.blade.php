@extends('layout.layout')
@section('title','Trang chủ')
@section('content')
<style>
    .carousel-inner{
        height: 600px;
    }
    .carousel-inner .carousel-item .carousel-caption{
        top: 480px;
    }
    .carousel-inner .carousel-item h5,span{
        color: #fff;
    }
</style>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active" >
            <img class="d-block w-100" src="https://i.pinimg.com/originals/39/d4/5a/39d45aa61ce17e003144ce2e1cedefb7.jpg" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <span>Nulla vitae elit libero, a pharetra augue mollis interdum.</span>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://static3.bigstockphoto.com/4/2/3/large1500/324149785.jpg" alt="Second slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <span>Nulla vitae elit libero, a pharetra augue mollis interdum.</span>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="https://hdwallsource.com/img/2019/4/fast-food-burgers-wallpaper-68908-71254-hd-wallpapers.jpg" alt="Third slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <span>Nulla vitae elit libero, a pharetra augue mollis interdum.</span>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
{{-- <section id="center">
    <div class="container">
     <div class="row">
      <div class="col-sm-6">
       <div class="center_1">
        <h1>Nulla Quis Sem Nibh Imperdiet?</h1>
        <p>Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. 
           Praesent mauris. Fusce nec tellus sed augue semper porta.</p>
        <p>Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet.</p>
        <a href="#" class="button"> ORDER NOW </a>	 
       </div>
      </div>
      <div class="col-sm-6">
       <div class="center_2">
        <a href="#"><img src="{{ asset('public/home/img/test1.png') }} " alt="abc" class="img_responsive"></a>
       </div>
      </div>
     </div>
    </div>
</section> --}}
   {{-- <section id="Spicy" class="clearfix"> 
      <div class="col-sm-6">
       <div class="Spicy_2">
        <a href="#"><img src="{{ asset('public/home/img/15.png') }} " alt="abc" class="img_responsive"></a>
       </div>
      </div>
      <div class="col-sm-6">
       <div class="Spicy_1">
        <h1>Sứ mệnh của chúng tôi</h1>
        <p>Bên cạnh những món ăn truyền thống như gà rán và Bơ-gơ, đến với thị trường Việt Nam, KFC đã chế biến
             thêm một số món để phục vụ những thức ăn hợp khẩu vị người Việt như: Gà Big‘n Juicy, Gà Giòn Không Xương, 
             Cơm Gà KFC, Bắp Cải Trộn … Một số món mới cũng đã được phát triển và giới thiệu tại thị trường Việt Nam, 
             góp phần làm tăng thêm sự đa dạng trong danh mục thực đơn, như: Bơ-gơ Tôm, Lipton, Bánh Egg Tart..</p>
        <a href="#" class="button"> ORDER NOW </a>	 
       </div>
       <div class="Spicy_2">
          <ul>
               <li><a class="btn btn-lg btn-primary big-btn" href="#">
                     <i class="glyphicon glyphicon-phone pull-left"></i><div class="btn-text"><small>Available on the</small><br><strong>App Store</strong></div></a></li>
               <li><a class="btn btn-lg btn-success big-btn android-btn" href="#">
                     <img width="60" class="pull-left" src="{{ asset('public/home/img/16.png') }}" alt="abc">
                   <div class="btn-text"><small>Available on</small><br><strong>Google Play</strong></div></a></li>	
          </ul>
       </div>
      </div>
   </section> --}}
   {{-- <div style="background-color: #333;"> --}}
   <section id="since">
    <div class="container">
     <div class="row">
      <div class="col-sm-6">
       <div class="since_1">
        <h1>Lorem Ipsum Dolor Sit Amet</h1>
        <p>Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.
           torquent per conubia nostra, per inceptos . Curabitursodales ligula in libero. </p>
        <p>Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum.</p>
        <a href="#" class="button"> ORDER NOW </a>	 
       </div>
      </div>
      <div class="col-sm-6">
       <div class="since_2">
        <a href="#"><img src=" {{ asset('public/home/img/18.png') }}" alt="abc" class="img_responsive"></a>
       </div>
      </div>
     </div>
    </div>
   </section>
   <section id="place">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="since_2">
                    <a href="#"><img src="{{ asset('public/home/img/chicken1.png') }} " alt="abc" class="img_responsive"></a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="since_1">
                    <h1>Dignissim Lacinia</h1>
                    <p>Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.
                    torquent per conubia nostra, per inceptos . Curabitursodales ligula in libero. </p>
                    <p>Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.torquent per conubia nostra, per inceptos</p>
                    <a href="#" class="button"> ORDER NOW </a>	 
                </div>
            </div>
        </div>
    </div>
</section>
{{-- </div> --}}
   {{-- Thông báo đăng nhập thành công --}}
   @if(session()->has('message1'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Đăng nhập thành công!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

   @if(session()->has('checkouted'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Thanh toán thành công!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
    {{-- Đăng nhập sai tài khoản hoặc mật khẩu --}}
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

@endsection