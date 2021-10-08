@extends('layout.layout_admin')
@section('title','Trang chủ quản trị')

<link rel="stylesheet" href="{{ asset('public/home/css/table.css') }}" type="text/css">
<script src="{{ asset('public/home/js/clickevent.js') }}"></script>
<style>
	ul.tabs-list{
		display: inline-flex;
		list-style-type: none;
	}
	ul.tabs-list li{
		margin-right: 10px;
	}
</style>

@section('breadcrumb')
    <div class="content-header">
		<div class="row ft-tabs">
			<div class="col-md-3">
				<ul class="tabs-list">
					<li><a class="btn btn-primary" href="{{ url('admin-table/0') }}" >Phòng Bàn</a></li>
					<li><a class="btn btn-primary" href="{{ url('admin-menu/0') }}">Thực đơn</a></li>
				</ul>
			</div>	
			<div class="col-md-9">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="{{'page-admin'}}">Trang chủ</a></li>
					<li class="breadcrumb-item active">Đặt Bàn</li>
				</ol>
			</div>
		</div>
    </div>
@endsection

@section('content')
	<div class="container-fluid">
		<div class="row content">
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
								<button type="button" class="btn-print" onclick="cms_save_table()"><i class="fa fa-credit-card" aria-hidden="true"></i> Thanh Toán (F9)</button>
							</div>
							<div class="col-md-6 col-xs-6 p-1">
								<button type="button" class="btn-pay" onclick="cms_save_oder()"><i class="fa fa-floppy-o" aria-hidden="true"></i> Lưu (F10)</button>
							</div>
						</div>
 					</div>
 					<div class="col-md-6">
 						<div class="row form-group">
							<label class="col-form-label col-md-4"><b>Tổng cộng</b></label>
							<div class="col-md-8">
								<input type="text" value="0" class="form-control total-pay" disabled="disabled">
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
<div class="alert-login">
</div>
<div class="modal fade" id="ModelAddcustomer" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.2/dist/sweetalert2.all.min.js"></script>

@endsection