@extends('layout.layout_admin')
@section('title', 'Trang danh sách sản phẩm')


@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{'page-admin'}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách sản phẩm</li>
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
                @if(session()->has('message'))
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Cập nhật thành công!',
                        showConfirmButton: false,
                        timer: 2000
                    })
                </script>
                @endif
                @if(session()->has('message1'))
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Đã thêm sản phẩm mới!',
                        showConfirmButton: false,
                        timer: 2000
                    })
                </script>
                @endif

                <!-- TO DO List -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            SẢN PHẨM
                        </h3>
                        <div class="card-tools">
                            <button  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
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
                                <th>Loại sản phẩm</th>
                                <th>Nhà sản xuất</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá bán</th>
                                <th>Hình ảnh</th>
                                <th scope="col" colspan="2">Tùy chọn</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($show_products as $key => $data)
                            <tr>
                                <td> {{ ++$key }}</td>
                                <td>
                                    @php($get_categorys = DB::table('categories')->where('id',$data->category_id)->get())
                                    @foreach($get_categorys as $get_category)
                                        {{ $get_category->category_name }}
                                    @endforeach
                                </td>

                                <td>
                                    @php($get_product_suppliers = DB::table('product_suppliers')->where('product_id',$data->id)->first())
                                    @php($get_suppliers = DB::table('suppliers')->where('id', $get_product_suppliers->supplier_id)->first())
                                    {{ $get_suppliers->supplier_name }}
                                </td>

                                @if($data->product_discount > 0)
                                    <td>
                                        {{ $data->product_name }}
                                        <img src="http://www.clipartsmania.com/gif/words/blinking-sale-text-animation.gif" width="20" height="20">
                                    </td>
                                @else
                                    <td>{{$data->product_name}}</td>
                                @endif

                                <td>{{$data->product_quantity}}</td>

                                @if($data->product_discount > 0)
                                <?php 
                                    $get_price = $data->product_price;
                                    $get_discount = $data->product_discount;
                                    $result = $get_price - ($get_price * $get_discount)/100;
                                ?>
                                <td>
                                    <del>{{number_format($data->product_price)}} VND/{{ $data->unit_price }}</del><br>
                                    {{number_format($result)}} VND/{{ $data->unit_price }}
                                </td>
                                @else
                                    <td>{{number_format($data->product_price)}} VND/{{ $data->unit_price }}</td>
                                @endif

                                <td>
                                    <img src="{{ url('public/home/upload_img/'.$data->product_img) }}"
                                         class="img-circle elevation-2" alt="Product Image " width="50px" height="40px">
                                </td>

                                <td>
                                    <a class="btn btn-danger btn-sm" href="{{url('delete-product/'.$data->id) }}" role="button" onclick="return confirm('Bạn có chắc muốn xóa không?');">
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                </td>

                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{ url('edit-product/'.$data->id) }}" role="button">
                                        <i class="fas fa-edit"></i> Đổi
                                    </a>
                                </td>
                            </tr>

                            @empty
                                <tr>
                                    <td colspan="11">
                                        <b class="text-danger">Không có dữ liệu </b>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <ul class="pagination justify-content-xl-end" style="margin:20px 0">
                            {{ $show_products->links() }}
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.Left col -->
        </div>
        <!-- /.row (main row) -->
    </section>
    {{-- Modal thêm mới sản phẩm --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('post-product') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" name="inputName" class="form-control" placeholder="Nhập tên sản phẩm">
                        <div class="invalid-feedback">Chưa nhập tên sản phẩm </div>
                    </div>

                    <div class="form-group">
                        <label for="">Loại sản phẩm</label>
                        <select name="inputCategoryId" class="form-control">
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
                        <label for="">Nhà cung cấp</label>
                        <select name="inputSupplier" class="form-control">
                            <option value=""> --Chọn--</option>
                            @php($get_suppliers = DB::table('suppliers')->get())
                            @foreach($get_suppliers as $value)
                                <option value="{{ $value->id }}">
                                    {{$value->supplier_name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="number" name="inputQuantity" class="form-control" placeholder="Nhập số lượng">
                    </div>

                    <div class="form-group">
                        <label for="">Giá sản phẩm</label>
                        <input type="number" name="inputPrice" class="form-control" placeholder="Nhập giá sản phẩm">
                    </div>


                    <div class="form-group">
                        <label for="">Hình ảnh</label>
                        <input type="file" class="form-control-file" id="imgInp" name="inputFileImage">
                        <img id="blah" src="#" style="max-width:100%;height:50px;border-radius:5px;"/>
                    </div>

                    <div class="form-group">
                        <label for="">Đơn vị tính</label>
                        <input type="text" name="inputUnitPrice" class="form-control" placeholder="Nhập đơn vị tính">
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
<script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        $("#imgInp").change(function() {
            readURL(this);
        });
    </script>
@endsection

