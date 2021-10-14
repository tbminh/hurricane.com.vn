<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
    <link rel="stylesheet" href="{{ url('public/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ url('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{url('public/plugins/jqvmap/jqvmap.min.css ')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('public/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('public/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('public/plugins/summernote/summernote-bs4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('public/home/css/table.css') }}" type="text/css">

    {{-- Sweet Alert --}}
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../public/js/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> --}}
	
</head>
<body>
	@yield('header-cashier')
	<style>
		table thead	 tr th{
			text-align: center;	
		}

		table tbody tr td{
			text-align: center;
		}
	</style>

    <div class="container-fluid">
		<div class="row content">
            {{-- Thông tin đặt bàn và thực đơn --}}
			@yield('content_table')
			<div class="col-md-6 content-listmenu" id="content-listmenu">
				<div class="row" id="bill-info">
				</div>
				
					<div class="row bill-detail">
						<div class="col-md-12 bill-detail-content">
							<table class="table table-bordered">
								<thead class="thead-light">
									<tr>
									<th scope="col">STT</th>
									<th scope="col">Tên sản phẩm</th>
									<th scope="col">Số lượng</th>
									<th scope="col">Giá bán</th>
									<th scope="col">Thành Tiền</th>
									<th scope="col"></th>
									</tr>
								</thead>
								<tbody id="pro_search_append">
									{{-- Không hiển thị table-cart khi chưa chọn món cho bàn --}}
										@if(isset($id_table))
											<form action="{{ url('checkout-table/'.$id_table) }}" class="checkout" method="POST">
											@csrf
											@php($show_carts = DB::table('table_carts')->where('table_id',$id_table)->get())
											<?php $total_price = 0; ?>
											@foreach ($show_carts as $key => $show_cart)
												@php($get_products = DB::table('products')->where('id',$show_cart->product_id )->first())
												<tr>
													<td> {{ ++$key }} </td>
													<td data-label="Tên sản phẩm">
														<span>{{ $get_products->product_name }}</span>
													</td>
													<td data-label="Số lượng"> 
														{{-- <input type="number" size="3" class="input-text qty text" name="quantity" value="{{ $show_cart->tc_quantity }}" min="0" step="1"> --}}
														<div class="input-group spinner">
															<button class="input-group-prepend btn btn-default"><i class="fa fas fa-minus"></i></button>
															<input type="number" style="width: 50px; text-align: center;" class="form-control quantity-product-oders"
																name="inputQty" value="{{ $show_cart->tc_quantity }}">
															<button class="input-group-prepend btn btn-default"><i class="fa fas fa-plus"></i></button>
														</div>
													</td>
													<td data-label="Giá">{{  number_format($get_products->product_price) }} VND/{{ $get_products->unit_price }} </td>
													<?php 
														$price = $get_products->product_price;
														$qty = $show_cart->tc_quantity;
														$total = $price * $qty;
														$total_price = $total_price + $total;
													?>
													<td data-label="Thành tiền">
														{{ number_format($total) }} VND
													</td>
													<td class="text-center">
														<i class="fa fa-times-circle del-pro-order"></i>
													</td>
												</tr>  
											@endforeach
											</form>
										@else
										@endif
								</tbody>
							</table>
						</div>
					</div>
					<div class="row bill-action">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12 p-1">
									<textarea class="form-control" id="note-order" placeholder="Nhập ghi chú hóa đơn" rows="3"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 col-xs-6 p-1">
									<button type="submit" class="btn-print" name="checkout">
										<i class="fa fa-credit-card" aria-hidden="true"></i> Thanh Toán (F9)
									</button>
								</div>
								<div class="col-md-6 col-xs-6 p-1">
									<button type="button" class="btn-pay">
										<i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu (F10)
									</button>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row form-group">
								<label class="col-form-label col-md-4"><b>Tổng cộng</b></label>
								<div class="col-md-8">
									@if(isset($id_table))
										<input type="text" value="{{ number_format($total_price) }} đ" class="form-control total-pay" disabled="disabled">
									@else
										<input type="text" value="0 đ" class="form-control total-pay" disabled="disabled">
									@endif
								</div>
							</div>
							<div class="row form-group">
								<label class="col-form-label col-md-4"><b>Khách Đưa</b></label>
								<div class="col-md-8">
									<input type="text" class="form-control customer-pay" value="0" placeholder="Nhập số điền khách đưa">
								</div>
							</div>
							<div class="row form-group">
								<label class="col-form-label col-md-4"><b>Tiền thừa</b></label>
								<div class="col-md-8 excess-cash">
									0
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</body>
<script>
    $(document).ready(function(){
	$('.ft-tabs .tabs-list li a').click(function(){
		$('.ft-tabs .tabs-list li a').removeClass("active");
		$(this).addClass("active");
		// var tab = $(this).attr('data');
		// if(tab=='listtable'){
		// 	$('#table-list').attr('hidden',false);
		// 	$('#table-list').load('table.php');
		// 	$('#pos').attr('hidden',true);
		// }else{
		// 	$('#table-list').attr('hidden',true);
		// 	$('#pos').attr('hidden',false);
		// }
	});
});
    
</script>