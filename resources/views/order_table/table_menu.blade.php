@extends('order_table.layout_table')
@section('title','Trang menu')
<div class="header-cashier">
    <div class="container-fluid">
        <div class="row ft-tabs">
            <div class="col-md-3">
                <ul class="tabs-list">
                    <li><a href="{{ url('table-manage/0') }}" data="listtable">Phòng Bàn</a></li>
                    <li><a href="{{ url('table-menu/0') }}" data="pos" class="active">Thực đơn</a></li>
                </ul>
            </div>
            <div class="col-md-4 cashier-search">
                <input type="text" name="txtnamemenu" id="search-menu" placeholder="Nhập tên mặt hàng" class="form-control">
                <div id="result-menu-post">
                    
                </div>
            </div>
            <div class="col-md-5">
                <span class="pull-right" style="color: #fff;"><i class="fa fa-user"></i> {{ Auth::user()->user_name }}</span>
            </div>
        </div>
    </div>
</div>
@section('content_table')

{{-- Hiển thị category --}}
<div class="col-md-6">
    <div class="row list-filter">
        <div class="col-md list-filter-content">
            <a class="btn btn-primary " href="{{ url('table-menu/'.$id_table.'/'.'0') }}">Tất Cả</a>
            <a class="btn btn-primary " href="{{ url('table-menu/'.$id_table.'/'.'7') }}">Combo</a>
            
            @foreach($show_cates as $show_cate)
                <a class="btn btn-primary" href="{{ url('table-menu/'.$id_table.'/'.$show_cate->id) }}">
                    {{ $show_cate->category_name }}
                </a>
            @endforeach	
        </div>
    </div>
{{-- Hiển thị món ăn theo category --}}
        <div class="row product-list">
            <div class="col-md product-list-content">
                {{-- Hiển thị combo --}}
                @if($id_cate == 7)
                    <ul>
                        @php($show_combos = DB::table('combos')->get())
                        @foreach ($show_combos as $show_combo)
                        <li>
                            {{-- Chọn bàn trước khi thêm sản phẩm --}}
                            @if($id_table == 0)
                                <a href="{{ url('table-manage/0') }}" onclick="return confirm('Vui lòng chọn bàn trước')">
                                    <div class="img-product">
                                        <img src="{{ asset('public/home/upload_img/'.$show_combo->combo_img) }}">
                                    </div>
                                    <div class="product-info">
                                        <span class="product-name">{{ $show_combo->combo_name }}</span><br>
                                        <strong>{{ number_format($show_combo->combo_total_price) }}₫</strong>
                                    </div>
                                </a>
                            @else
                                <a href="{{ url('add-combo-tbcart/'.Auth::id().'/'.$id_table.'/'.$show_combo->id) }}">
                                    <div class="img-product">
                                        <img src="{{ asset('public/home/upload_img/'.$show_combo->combo_img) }}">
                                    </div>
                                    <div class="product-info">
                                        <span class="product-name">{{ $show_combo->combo_name }}</span><br>
                                        <strong>{{ number_format($show_combo->combo_total_price) }}₫</strong>
                                    </div>
                                </a>	
                            @endif
                        </li>
                        @endforeach
                    </ul>
                @else
                {{-- Hiển thị sản phẩm theo category --}}
                    <ul>
                        @foreach ($show_products as $show_product)
                            <li>
                                {{-- Chọn bàn trước khi thêm sản phẩm --}}
                                @if($id_table == 0)
                                    <a href="{{ url('table-manage/0') }}" onclick="return confirm('Vui lòng chọn bàn trước')"
                                        title="Số lượng còn lại: {{ $show_product->product_quantity }}">
                                        <div class="img-product">
                                            <img src="{{ asset('public/home/upload_img/'.$show_product->product_img) }}">
                                        </div>
                                        <div class="product-info">
                                            <span class="product-name">{{ $show_product->product_name }}</span><br>
                                            <strong>{{ number_format($show_product->product_price) }}₫</strong>
                                        </div>
                                    </a>
                                @else
                                    <a href="{{ url('add-table-cart/'.Auth::id().'/'.$id_table.'/'.$show_product->id) }}" title="Số lượng: {{ $show_product->product_quantity }}">
                                        <div class="img-product">
                                            <img src="{{ asset('public/home/upload_img/'.$show_product->product_img) }}">
                                        </div>
                                        <div class="product-info">
                                            <span class="product-name">{{ $show_product->product_name }}</span><br>
                                            <strong>{{ number_format($show_product->product_price) }}₫</strong>
                                        </div>
                                    </a>	
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <ul class="pagination justify-content-xl-center" style="margin:20px 0">
            {{ $show_products->links() }}
        </ul>
</div>
@endsection