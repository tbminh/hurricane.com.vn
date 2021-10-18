@extends('layout.layout')
@section('title','Trang thực đơn')
@section('content')
<style>
   
</style>
<div class="collection_text">
    MENU
</div>

<section id="products">
    <div class="container">
        <div class="row products_main clearfix">
            @foreach($show_cates as $show_cate)
                <div class="col-sm-4">
                        <div class="products_2">
                            <a href="#"><img src="{{ url('public/home/upload_img/'.$show_cate->category_image) }} " alt="abc" class="img_responsive"></a>
                            <p><a href="{{ url('page-product/'.Str::slug($show_cate->category_name).'/'.$show_cate->id) }}">
                                {{ $show_cate->category_name }}
                            </a></p>
                        </div>
                    
                </div>
            @endforeach 
        </div>
    </div>
</section>

@endsection