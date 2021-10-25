@extends('layout.layout_admin')
@section('title', 'Trang danh sách combo')


@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('page-admin')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{url('page-combo-product')}}">Trang combo</a></li>
                        <li class="breadcrumb-item active">Chi tiết combo</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection


@section('content')
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
    {{--        Hiển thị dòng thông báo đã thêm thành công--}}
                @if(session()->has('delete'))
                    <script>
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Xóa thành công!',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    </script>
                @endif

                @if(session()->has('success'))
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Thêm thành công!',
                        showConfirmButton: false,
                        timer: 2000
                    })
                </script>
                @endif

                @php($get_combo = DB::table('combos')->where('id',$id_combo)->first())
                <!-- TO DO List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            {{ $get_combo->combo_name }}
                        </h3>
                        <div class="card-tools">
                            <button role="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#exampleModal" >
                                <i class="fa fa-plus-circle"></i> Thêm sản phẩm
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-1">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Hình Ảnh</th>
                                <th>Số Lượng</th>
                                <th>Giá</th>
                                <th>Tùy Chọn</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($show_details as $key => $data)
                                @php($get_product = DB::table('products')->where('id',$data->product_id)->first())
                                <tr>
                                    <td> {{ ++$key }}</td>
                                    <td>{{$get_product->product_name}}</td>
                                    <td>
                                        <img src="{{ url('public/home/upload_img/'.$get_product->product_img) }}"
                                            class="img-circle elevation-2" alt="Product Image " width="50px" height="40px">
                                    </td>
                                    <td>{{number_format($data->quantity_combo)}}</td>
                                    <td>{{number_format($get_product->product_price)}} VND</td>
                                    <td>
                                        <a class="btn btn-danger btn-sm" href="{{url('delete-product-combo/'.$data->id) }}" role="button" onclick="return confirm('Bạn có chắc muốn xóa không?');">
                                            <i class="fa fa-trash"></i> Xóa
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
        
    </section>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{ $get_combo->combo_name }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('post-add-cd/'.$id_combo) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="Category">Loại sản phẩm</label>
                        <select class="form-control productcategory" data-type="cate">
                            <option value=""> --Chọn--</option>
                            @php($get_categories = DB::table('categories')->get())
                            @foreach($get_categories as $value)
                                <option value="{{ $value->id }}">
                                    {{$value->category_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="productCategory">Sản phẩm</label>
                        <select name="inputProduct" class="form-control product-name">
                            <option value="0" disabled="true" selected="true">Tên sản phẩm</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="number" name="inputQuantity" class="form-control" placeholder="Nhập số lượng">
                    </div>

                    <div class="form-group row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-primary btn-sm">Thêm</button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
    
    <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','.productcategory', function () {
            var cate_id = $(this).val();    

            var div = $(this).parent().parent();
            var op = " ";
            
            $.ajax({
                type: "get",
                url: "{{ url('findProductName') }}",
                data: {'id':cate_id},
                // dataType: "dataType",
                success: function (data) {
                    console.log("success");
                    console.log(data);
                    console.log(data.length);

                    op += '<option value="0" selected disabled>Chọn sản phẩm</option>';
                    for(var i=0;i<data.length;i++){
                        op += '<option value="'+data[i].id+'">'+data[i].product_name+'</option>'
                    }

                    div.find('.form-group .product-name').html(" ");
                    div.find('.form-group .product-name').append(op);
                },
                error:function(){

                }
            });
        });
    });
    </script>
@endsection

