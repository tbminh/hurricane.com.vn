@extends('admin.table_manage.layout_admin_table')
@section('content_table')


{{-- Hiển thị category --}}
    <div class="col-md-6">
        <div class="row list-filter">
            <div class="col-md list-filter-content">
                <a class="btn btn-primary " href="{{ url('admin-menu/0') }}">Tất Cả</a>
                
                    @foreach($show_cates as $show_cate)
                        <a class="btn btn-primary" href="{{ url('admin-menu/'.$show_cate->id) }}">
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
                                <a href="#" title="{{ $show_product->product_name }}">
                                    <div class="img-product">
                                        <img src="{{ asset('public/home/upload_img/'.$show_product->product_img) }}">
                                    </div>
                                    <div class="product-info">
                                        <span class="product-name">{{ $show_product->product_name }}</span><br>
                                        <strong>{{ number_format($show_product->product_price) }}₫</strong>
                                    </div>
                                </a>	
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