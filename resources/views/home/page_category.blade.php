@extends('layout.layout')
@section('title','Trang thực đơn')
@section('content')



<section id="test">
    <div class="container">
     <div class="row">
      <div class="products_1">
       <h2 style="color: #B06565;">MENU</h2>
      </div>
     </div> 
    </div>
</section>

<section id="products">
    <div class="container">
        <div class="row">
            <div class="products_main clearfix">
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
    </div>
</section>

@endsection