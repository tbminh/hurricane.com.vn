@extends('layout.layout')
@section('title','Trang chủ')
@section('content')

<section id="center">
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
   </section>
   <section id="middle" class="clearfix">
     <div class="col-sm-12 space_all">
                   <div id="Carousel" class="carousel slide">                
                   <ol class="carousel-indicators">
                       <li data-target="#Carousel" data-slide-to="0" class="active"></li>
                       <li data-target="#Carousel" data-slide-to="1"></li>
                       <li data-target="#Carousel" data-slide-to="2" class=""></li>
                   </ol>                 
                   <!-- Carousel items -->
                   <div class="carousel-inner">                    
                   <div class="item active">
                       <div class="row">
                         <div class="col-lg-3 col-md-4 col-sm-6">
                         <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/3.jpg') }} " alt="abc" class="img_responsive"></a>
                         </div>
                         <div class="col-lg-3 col-md-4 col-sm-6">
                         <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/4.jpg') }} " alt="abc" class="img_responsive"></a>
                         </div>
                         <div class="col-lg-3 col-md-4 col-sm-6">
                         <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/5.jpg') }} " alt="abc" class="img_responsive"></a>
                         </div>
                         <div class="col-lg-3 col-md-4 col-sm-6">
                         <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/6.jpg') }} " alt="abc" class="img_responsive"></a>
                         </div>
                       </div><!--.row-->
                   </div><!--.item-->                 
                   <div class="item">
                       <div class="row">
                           <div class="col-lg-3 col-md-4 col-sm-6">
                           <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/7.jpg') }} " alt="abc" class="img_responsive"></a>
                           </div>
                           <div class="col-lg-3 col-md-4 col-sm-6">
                           <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/8.jpg') }} " alt="abc" class="img_responsive"></a>
                           </div>
                           <div class="col-lg-3 col-md-4 col-sm-6">
                           <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/9.jpg') }} " alt="abc" class="img_responsive"></a>
                           </div>
                           <div class="col-lg-3 col-md-4 col-sm-6">
                           <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/10.jpg') }} " alt="abc" class="img_responsive"></a>
                           </div>
                       </div><!--.row-->
                   </div><!--.item-->                 
                   <div class="item">
                       <div class="row">
                           <div class="col-lg-3 col-md-4 col-sm-6">
                           <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/11.jpg') }} " alt="abc" class="img_responsive"></a>
                           </div>
                           <div class="col-lg-3 col-md-4 col-sm-6">
                           <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/12.jpg') }} " alt="abc" class="img_responsive"></a>
                           </div>
                           <div class="col-lg-3 col-md-4 col-sm-6">
                           <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/13.jpg') }} " alt="abc" class="img_responsive"></a>
                           </div>
                           <div class="col-lg-3 col-md-4 col-sm-6">
                           <a href="#" class="thumbnail"><img src="{{ asset('public/home/img/14.jpg') }} " alt="abc" class="img_responsive"></a>
                           </div>
                       </div><!--.row-->
                   </div><!--.item-->                 
                   </div><!--.carousel-inner-->
                   </div><!--.Carousel-->               
           </div>
   </section>
   <section id="Spicy" class="clearfix"> 
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
   </section>
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