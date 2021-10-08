<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Complete Responsive Food Website Design Tutorial</title>



  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <!-- custom css file link  -->
  <link rel="stylesheet" href="css/styleGiohang.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
  <style>
    html {
    background: #ffffff;
    font: 62.5%/1.5em "Trebuchet Ms", helvetica;
    }

    * {
        box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
        font-smooth: antialiased;
    }

    @font-face {
        font-family: 'Shopper';
        src: url('http://www.shopperfont.com/font/Shopper-Std.ttf');
    }

    .shopper {
        text-transform: lowercase;
        font: 2em 'Shopper', sans-serif;
        line-height: 0.5em;
        display: inline-block;
    }

    h1 {
        text-transform: uppercase;
        font-weight: bold;
        font-size: 2.5em;
    }

    p {
        font-size: 1.5em;
        color: #8a8a8a;
    }

    input {
        border: 0.3em solid #bbc3c6;
        padding: 0.5em 0.3em;
        font-size: 1.4em;
        color: #8a8a8a;
        text-align: center;
    }

    img {
        max-width: 9em;
        width: 100%;
        overflow: hidden;
        margin-right: 1em;
    }

    a {
        text-decoration: none;
    }

    .container {
        max-width: 75em;
        width: 95%;
        margin: 40px auto;
        overflow: hidden;
        position: relative;
        border-radius: 0.6em;
        /*mau back rau trong*/
        background: #d4d4ad93;
        box-shadow: 0 0.5em 0 rgba(41, 32, 175, 0.2);
    }


    /*màu vùng trên*/

    .heading {
        padding: 1em;
        position: relative;
        z-index: 1;
        color: #f7f7f7;
        background: #e47114;
    }

    .cart {
        margin: 2.5em;
        overflow: hidden;
    }

    .cart.is-closed {
        height: 0;
        margin-top: -2.5em;
    }

    .table {
        background: #ffffff;
        border-radius: 0.6em;
        overflow: hidden;
        clear: both;
        margin-bottom: 1.8em;
    }

    .layout-inline>* {
        display: inline-block;
    }

    .align-center {
        text-align: center;
    }


    /*màu sản phẩm giá*/

    .th {
        background: #e47114;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 1.5em;
    }


    /*màu Tổng tiền*/

    .tf {
        background: #e47114;
        text-transform: uppercase;
        text-align: right;
        font-size: 1.2em;
    }

    .tf p {
        color: #fff;
        font-weight: bold;
    }

    .col {
        padding: 1em;
        width: 12%;
    }

    .col-pro {
        width: 44%;
    }

    .col-pro>* {
        vertical-align: middle;
    }

    .col-qty {
        text-align: center;
        width: 17%;
    }

    .col-numeric p {
        font: bold 1.8em helvetica;
    }

    .col-total p {
        color: #f50000;
    }

    .tf .col {
        width: 20%;
    }

    .row>div {
        vertical-align: middle;
    }

    .row-bg2 {
        background: #f7f7f7;
    }

    .visibility-cart {
        position: absolute;
        color: #fff;
        top: 0.5em;
        right: 0.5em;
        font: bold 2em arial;
        border: 0.16em solid #fff;
        border-radius: 2.5em;
        padding: 0 0.22em 0 0.25em;
    }

    .col-qty>* {
        vertical-align: middle;
    }

    .col-qty>input {
        max-width: 4em;
    }

    a.qty {
        width: 1em;
        line-height: 1em;
        border-radius: 2em;
        font-size: 2.5em;
        font-weight: bold;
        text-align: center;
        background: #43ace3;
        color: #fff;
    }

    a.qty:hover {
        background: #3b9ac6;
    }


    /*mau cái núc*/

    .btn {
        padding: 10px 30px;
        border-radius: 0.3em;
        font-size: 1.4em;
        font-weight: bold;
        background: #00ca11b2;
        color: #fff;
        box-shadow: 0 3px 0 rgba(59, 154, 198, 1)
    }

    .btn1 {
        padding: 10px 30px;
        border-radius: 0.3em;
        font-size: 1.4em;
        font-weight: bold;
        background: #00ca11b2;
        color: #fff;
        box-shadow: 0 3px 0 rgba(59, 154, 198, 1)
    }

    .btn:hover {
        box-shadow: 0 3px 0 rgba(59, 154, 198, 0)
    }

    .btn-update {
        float: right;
        margin: 0 0 1.5em 0;
    }

    .transition {
        transition: all 0.3s ease-in-out;
    }

    @media screen and ( max-width: 755px) {
        .container {
            width: 98%;
        }
        .col-pro {
            width: 35%;
        }
        .col-qty {
            width: 22%;
        }
        img {
            max-width: 100%;
            margin-bottom: 1em;
        }
    }

    @media screen and ( max-width: 591px) {}
</style>
</head>

<body>
    <div class="container">
        <br>
        <div class="heading">
            <h1>
                <span class="shopper"></span> Đặt Bàn Số {{ $id }}
            </h1>
            <a href="{{ url('cancel-table-cart/'.$id) }}" onclick="return confirm('Bạn có muốn hủy bàn?')" title="Hủy Bàn" class="visibility-cart transition is-open">X</a>
        </div>
        <form action="{{ url('post-table-cart/'.$id) }}" method="post">
            @csrf
            <div class="row">
                <div  class="col-sm-6 col-md-6 "></div>
                <div class="col-sm-6 col-md-2 ">
                    <button type="submit" name="update" class="btn btn-update">THANH TOÁN</button> 
                </div>

                <div class="col-sm-6 col-md-2 ">
                    <a type="btn" class="btn btn-update"  href="{{ url('page-table') }}"> Chọn Bàn </a>
                </div>
                <div  class="col-sm-6 col-md-2 ">
                    <a type="btn" class="btn btn-update"  href="{{ url('page-table-category/'.$id) }}"> Thêm Món </a>&nbsp;
                </div>
            </div><br />
            
            <div class="table">
                <div class="layout-inline row th">
                    <div class="col col-pro">Sản Phẩm</div>
                    <div class="col col-price align-center ">
                    Giá
                    </div>
                    <div class="col col-qty align-center">Số Lượng</div>
                    <div class="col">Tổng</div>
                    <div class="col">Xóa</div>
                </div>
                    @forelse ($show_table_carts as $show_table_cart)
                        @php($show_product = DB::table('products')->where('id',$show_table_cart->product_id)->first())
                        <div class="layout-inline row">
                            <div class="col col-pro layout-inline">
                                <img src="{{ asset('public/home/upload_img/'.$show_product->product_img) }}"/>
                                <p>{{ $show_product->product_name }}</p>
                            </div>
                            <div class="col col-price col-numeric align-center ">
                                <p>{{ number_format($show_product->product_price)  }}₫</p>
                            </div>
                            <div class="col col-qty layout-inline">
                                <input name="inputQty" type="number" value="{{ $show_table_cart->tc_quantity }}"/>   
                            </div>
                            <div class="col col-total col-numeric">
                                <p>{{ $show_product->product_price * $show_table_cart->tc_quantity}}</p>
                            </div>
                            <div class="col col-vat col-numeric">
                                <a href="{{ url('delete-product-tc/'.$show_table_cart->id) }}" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-remove"></i></a>
                            </div>
                        </div> 
                    @empty
                            <p>Rỗng</p>
                    @endforelse
                <div class="tf">
                    <div class="row layout-inline">
                    <div class="col">
                        <p>Tổng Tiền</p>
                        <p>50.00 VNĐ</p>
                    </div>
                    <div class="col"></div>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</body>
@if(session()->has('message'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Đã xóa thành công!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
@endif
</html>