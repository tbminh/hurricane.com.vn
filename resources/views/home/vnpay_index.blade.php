<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo mới đơn hàng</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('public/home/vnpay/bootstrap.min.css')}}" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="{{asset('public/home/vnpay/jumbotron-narrow.css')}}" rel="stylesheet">
    <script src="{{asset('public/home/vnpay/jquery-1.11.3.min.js')}}"></script>
</head>

<body>

<div class="container">
    <div class="header clearfix">
        <h3  class="text-muted text-center">XÁC NHẬN THÔNG TIN THANH TOÁN</h3>
    </div>
    <h3>THÔNG TIN THANH TOÁN</h3>
    <div class="table-responsive">
       
        <form action="{{ url('checkout-online/'.Auth::id()) }}" id="create_form" method="post">
            @csrf
            {{-- <div class="form-group">
                <label for="language">Loại hàng hóa </label>
                <select name="order_type" id="order_type" class="form-control">
                    <option value="topup">Chọn ... </option>
                    <option value="billpayment">Thanh toán hóa đơn</option>
                    <option value="fashion">Thanh toán nợ</option>
                    <option value="other">Khác - Xem thêm tại VNPAY</option>
                </select>
            </div> --}}
            <div class="form-group">
                <label for="order_id">Mã hóa đơn</label>
                <input class="form-control" id="order_id" name="order_id" type="text" value="<?php echo date("YmdHis") ?>"/>
            </div>
            <div class="form-group">
                <label for="amount">Số tiền</label>
                <input class="form-control" id="amount"
                       name="amount" type="number" value="{{$total}}"/>
            </div>
            <div class="form-group">
                <label for="order_desc">Nội dung thanh toán</label>
                <textarea class="form-control" cols="20" id="order_desc" name="order_desc" rows="2" required="required">Nội dung thanh toán</textarea>
            </div>
            <div class="form-group">
                <label for="bank_code">Ngân hàng</label>
                <select name="bank_code" id="bank_code" class="form-control">
                    <option value="">----- Chọn Ngân Hàng ------</option>
                    <option value="NCB"> Ngan hang NCB</option>
                    <option value="AGRIBANK"> Ngan hang Agribank</option>
                    <option value="SCB"> Ngan hang SCB</option>
                    <option value="SACOMBANK">Ngan hang SacomBank</option>
                    <option value="EXIMBANK"> Ngan hang EximBank</option>
                    <option value="MSBANK"> Ngan hang MSBANK</option>
                    <option value="NAMABANK"> Ngan hang NamABank</option>
                    <option value="VNMART"> Vi dien tu VnMart</option>
                    <option value="VIETINBANK">Ngan hang Vietinbank</option>
                    <option value="VIETCOMBANK"> Ngan hang VCB</option>
                    <option value="HDBANK">Ngan hang HDBank</option>
                    <option value="DONGABANK"> Ngan hang Dong A</option>
                    <option value="TPBANK"> Ngân hàng TPBank</option>
                    <option value="OJB"> Ngân hàng OceanBank</option>
                    <option value="BIDV"> Ngân hàng BIDV</option>
                    <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                    <option value="VPBANK"> Ngan hang VPBank</option>
                    <option value="MBBANK"> Ngan hang MBBank</option>
                    <option value="ACB"> Ngan hang ACB</option>
                    <option value="OCB"> Ngan hang OCB</option>
                    <option value="IVB"> Ngan hang IVB</option>
                    <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                </select>
            </div>
            <div class="form-group">
                <label for="language">Ngôn ngữ</label>
                <select name="language" id="language" class="form-control">
                    <option value="vn">Tiếng Việt</option>
                    <option value="en">English</option>
                </select>
            </div>

            @if(Auth::check())
                <div class="form-group">
                    <label >Họ tên (*)</label>
                    <input class="form-control" id="txt_billing_fullname"
                           name="txt_billing_fullname" type="text" value="{{ Auth::user()->full_name }}"/>
                </div>
                <div class="form-group">
                    <label >Email (*)</label>
                    <input class="form-control" id="txt_billing_email"
                           name="txt_billing_email" type="text" value="{{ Auth::user()->email }}"/>
                </div>
                <div class="form-group">
                    <label >Số điện thoại (*)</label>
                    <input class="form-control" id="txt_billing_mobile"
                           name="txt_billing_mobile" type="text" value="{{ Auth::user()->phone }}"/>
                </div>
                <div class="form-group">
                    <label >Địa chỉ (*)</label>
                    <input class="form-control" id="txt_billing_addr1"
                           name="txt_billing_addr1" type="text" value="{{ Auth::user()->address }}"/>
                </div>
                <input type="hidden" id="id_user" name="id_user" value="{{ Auth::user()->id }}">
            @endif
            <button type="submit" class="btn btn-primary" id="btnPopup">Thanh toán Post</button>
            <button type="submit" name="redirect" id="redirect" onclick="history.back()" class="btn btn-default">Thanh toán Redirect</button>

        </form>
        
        
    </div>
    <p>
        &nbsp;
    </p>
    <footer class="footer">
        <p>&copy; VNPAY <?php echo date('Y')?></p>
    </footer>
</div>




</body>
</html>
