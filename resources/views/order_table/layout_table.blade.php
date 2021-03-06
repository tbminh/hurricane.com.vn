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
	@if(session()->has('success'))
		<script>
			Swal.fire({
				position: 'center',
				icon: 'success',
				title: 'Thanh to??n th??nh c??ng!',
				showConfirmButton: false,
				timer: 2000
			})
		</script>
	@endif
	
	@if(session()->has('delete'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'X??a th??nh c??ng!',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif

    <div class="container-fluid">
		<div class="row content">
            {{-- Th??ng tin ?????t b??n v?? th???c ????n --}}
			@yield('content_table')
			@if (!isset($id_table))
				<?php $id_table = 0;?>
			@endif
			
			<div class="col-md-6 content-listmenu" id="content-listmenu">
				<form method="POST" role="form" action="{{ url('checkout-table/'.$id_table) }}"  >
				@csrf
					<div class="row" id="bill-info">
					</div>
					<div class="row bill-detail">
						<div class="col-md-12 bill-detail-content">
							<table class="table table-bordered">
								<thead class="thead-light">
									<tr>
									<th scope="col">STT</th>
									<th scope="col">T??n s???n ph???m</th>
									<th scope="col">S??? l?????ng</th>
									<th scope="col">H??nh ???nh</th>
									<th scope="col">Gi??</th>
									<th scope="col">Th??nh Ti???n</th>
									<th scope="col"></th>
									</tr>
								</thead>
								<tbody id="pro_search_append">
									{{-- Kh??ng hi???n th??? table-cart khi ch??a ch???n m??n cho b??n --}}
										@if($id_table != 0)
											@php($show_carts = DB::table('table_carts')->where('table_id',$id_table)->get())
											<?php $total_price = 0; ?>
											@foreach ($show_carts as $key => $show_cart)
												@php($get_products = DB::table('products')->where('id',$show_cart->product_id )->first())
												<tr>
													<td> {{ ++$key }} </td>
													@if ($get_products != NULL)
														<td data-label="T??n s???n ph???m">
															<span>{{ $get_products->product_name }}</span>
														</td>
														<td data-label="S??? l?????ng"> 
															<div class="input-group spinner">
																<a class="btn btn-default dec" data="{{ $show_cart->id  }}">
																	<i class="fa fas fa-minus"></i>
																</a>
																<input type="number" style="width: 50px; text-align: center;" class="form-control quantity-product-oders"
																	name="inputQty" value="{{ $show_cart->tc_quantity }}" id="cartqty_{{ $show_cart->id }}"
																	onchange="myFunction({{ $show_cart->id }} + ',' + this.value)">
																<a class="btn btn-default inc" data="{{ $show_cart->id  }}">
																	<i class="fa fas fa-plus"></i>
																</a>
															</div>
														</td>
														<td>
															<img src="{{ asset('public/home/upload_img/'.$get_products->product_img) }}" class="img-circle elevation-2" width="40px" height="40px">
														</td>
														<td data-label="Gi??">{{  number_format($get_products->product_price) }} VND/{{ $get_products->unit_price }} </td>
														<?php 
															$price = $get_products->product_price;
															$qty = $show_cart->tc_quantity;
															$total = $price * $qty;
															$total_price = $total_price + $total;
														?>
														<td data-label="Th??nh ti???n">
															{{ number_format($total) }} VND
														</td>
														<td class="text-center">
															<a href="#" class="deLete" data="{{ $show_cart->id  }}" title="X??a" >
																<i class="fa fa-times-circle del-pro-order"></i>
															</a>
														</td>
													@else
														@php($get_combos = DB::table('combos')->where('id',$show_cart->combo_id )->first())
														<td data-label="T??n combo">
															<span>{{ $get_combos->combo_name }}</span>
														</td>
														<td data-label="S??? l?????ng"> 
															<div class="input-group spinner">
																<a class="btn btn-default dec" data="{{ $show_cart->id  }}">
																	<i class="fa fas fa-minus"></i>
																</a>
																<input type="number" style="width: 50px; text-align: center;" class="form-control quantity-product-oders"
																	name="inputQty" value="{{ $show_cart->tc_quantity }}" id="cartqty_{{ $show_cart->id }}"
																	onchange="myFunction({{ $show_cart->id }} + ',' + this.value)">
																<a class="btn btn-default inc" data="{{ $show_cart->id  }}">
																	<i class="fa fas fa-plus"></i>
																</a>
															</div>
														</td>
														<td>
															<img src="{{ asset('public/home/upload_img/'.$get_combos->combo_img) }}" class="img-circle elevation-2" width="40px" height="40px">
														</td>
														<td data-label="Gi??">{{  number_format($get_combos->combo_total_price) }} VND/Combo </td>
														<?php 
															$price = $get_combos->combo_total_price;
															$qty = $show_cart->tc_quantity;
															$total = $price * $qty;
															$total_price = $total_price + $total;
														?>
														<td data-label="Th??nh ti???n">
															{{ number_format($total) }} VND
														</td>
														<td class="text-center">
															<a href="#" class="deLete" data="{{ $show_cart->id  }}" title="X??a" >
																<i class="fa fa-times-circle del-pro-order"></i>
															</a>
														</td>
													@endif
												</tr>
											@endforeach
										@endif
								</tbody>
							</table>
						</div>
					</div>
					<div class="row bill-action">
						<div class="col-md-6">
							<div class="row">
								<div class="col-md-12 p-1">
									<textarea class="form-control" id="note-order" placeholder="Nh???p ghi ch?? h??a ????n" rows="3"></textarea>
								</div>
							</div>
							@if ($id_table == 0)
								<div class="row">
									<div class="col-md-6 col-xs-6 p-1">
										<button type="submit" class="btn-print" disabled>
											<i class="fa fa-credit-card" aria-hidden="true"></i> Thanh To??n 
										</button>
									</div>
									<div class="col-md-6 col-xs-6 p-1">
										<button type="button" class="btn-pay" disabled>
											<i class="fa fa-floppy-o" aria-hidden="true"></i> X??a B??n 
										</button>
									</div>
								</div>
							@else
								<div class="row">
									<div class="col-md-6 col-xs-6 p-1">
										<button type="submit" class="btn-print" >
											<i class="fa fa-credit-card" aria-hidden="true"></i> Thanh To??n 
										</button>
									</div>
									<div class="col-md-6 col-xs-6 p-1">
										<a type="button" class="btn-pay" href="{{ url('delete-table-cart/'.$id_table) }}" >
											<i class="fa fa-trash" aria-hidden="true"></i> X??a B??n
										</a>
									</div>
								</div>
							@endif
							
						</div>
						<div class="col-md-6">
							<div class="row form-group">
								<label class="col-form-label col-md-4"><b>T???ng c???ng</b></label>
								<div class="col-md-8">
									@if($id_table != 0)
										<input type="text" value="{{ number_format($total_price) }} ??" class="form-control total-pay" disabled="disabled">
									@else
										<input type="text" value="0 ??" class="form-control total-pay" disabled="disabled">
									@endif
								</div>
							</div>
							<div class="row form-group">
								<label class="col-form-label col-md-4"><b>Kh??ch ????a</b></label>
								<div class="col-md-8">
									<input type="text" class="form-control customer-pay" value="0"  placeholder="Nh???p s??? ??i???n kh??ch ????a">
								</div>
							</div>
							<div class="row form-group">
								<label class="col-form-label col-md-4"><b>Ti???n th???a</b></label>
								<div class="col-md-8 excess-cash">
									0
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

<script>
	//T??nh ti???n th???a
	$('.customer-pay').keyup(function(){
		var customer_pay;
		if($(this).val()==''){
			customer_pay=0;
		}else{
			customer_pay = cms_decode_currency_format($(this).val());
		}
		var total_pay = cms_decode_currency_format($('.total-pay').val());
		var debt = customer_pay - total_pay;
		$(this).val(cms_encode_currency_format(customer_pay));
		$('.excess-cash').html(cms_encode_currency_format(debt));
	});
	function cms_decode_currency_format(obs) {
    if (obs == '')
        return 0;
    else
        return parseInt(obs.replace(/,/g, ''));
	}
	function cms_encode_currency_format(obs) {
		return obs.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	//B???t s??? ki???n click n??t t??ng gi???m
	$('.btn-default').click(function(){
		var key = $(this).attr('data');
		var cartqty = $('#cartqty_'+key).val();
		if($(this).hasClass('inc')){
			$('#cartqty_'+key).val(parseInt(cartqty) + 1);
			update_cart(key,parseInt(cartqty) + 1);
		} 
		else if($(this).hasClass('dec')){
			$('#cartqty_'+key).val(parseInt(cartqty) - 1);
			update_cart(key,parseInt(cartqty) - 1);
		}
	});
	//L???y id v?? gi?? tr??? s??? l?????ng c???a sp
	function myFunction(e) {
		var ele = e.split(",");
		update_cart(ele[0],ele[1]);
	}

	//H??m c???p nh???t s??? l?????ng
	function update_cart(key,qty){
		$.ajax({
			url: "{{ url('update-cart') }}/"+key+"/"+qty,
			success:function(result){
				location.reload();
			}
		})
	}

	//B???t s??? ki???n n??t x??a
	$('.delete').click(function(){
		var key = $(this).attr('data');
		delete_cart(key);
	});

	//H??m x??a
	function delete_cart(key){
		$.ajax({
			url: "{{ url('delete-table-cart') }}/"+key,
			success:function(result){
				location.reload();
			}
		})
	}

	//L???y ti???n th???a
	// $('.customer-pay').change(function(){
	// 	var money =  parseInt(this.value);
	// 	var total = parseInt($("#total-pay").val());
	// 	var excess = total - money;
	// });
</script>
