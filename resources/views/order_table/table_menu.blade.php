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
        </div>
    </div>
</div>
@section('content_table')

{{-- Hiển thị category --}}
<div class="col-md-6">
    <div class="row list-filter">
        <div class="col-md list-filter-content">
            <a class="btn btn-primary " href="{{ url('table-menu/'.$id_table.'/'.'0') }}">Tất Cả</a>
            
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
                <ul>
                    @foreach ($show_products as $show_product)
                        <li>
                            {{-- Chọn bàn trước khi thêm sản phẩm --}}
                            @if($id_table == 0)
                                <a href="{{ url('table-manage/0') }}" onclick="return confirm('Vui lòng chọn bàn trước')" title="{{ $show_product->product_name }}">
                                    <div class="img-product">
                                        <img src="{{ asset('public/home/upload_img/'.$show_product->product_img) }}">
                                    </div>
                                    <div class="product-info">
                                        <span class="product-name">{{ $show_product->product_name }}</span><br>
                                        <strong>{{ number_format($show_product->product_price) }}₫</strong>
                                    </div>
                                </a>
                            @else
                                <a href="{{ url('add-table-cart/'.$id_table.'/'.$show_product->id) }}" title="{{ $show_product->product_name }}">
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
            </div>
        </div>
        <ul class="pagination justify-content-xl-center" style="margin:20px 0">
            {{ $show_products->links() }}
        </ul>
</div>
@endsection