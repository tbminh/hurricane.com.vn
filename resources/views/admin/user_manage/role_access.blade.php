@extends('layout.layout_admin')
@section('title','Trang quyền truy cập')

@section('link_css')
{{--    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>--}}
@endsection

@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('page-admin') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Quyền truy cập</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection


@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <section class="col-lg-6 connectedSortable">
                    <!-- TO DO List -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                THÊM QUYỀN TRUY CẬP
                            </h3>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body p-1">
                            <form action="{{ url('post-add-role-access') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Tên quyền:</label>
                                    <input type="text" name="inputRoleName" class="form-control"
                                           placeholder="Nhập tên quyền..." required>
                                    <div class="invalid-feedback">Chưa nhập tên quyền</div>
                                    <small class="text-danger">{{ $errors->first('inputRoleName') }}</small>
                                </div>

                                <div class="form-group">
                                    <label for="">Mô tả</label>
                                    <textarea class="form-control" name="inputDescript" id="" rows="8" placeholder="Nhập mô tả..."></textarea>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10 text-right">
                                        <button type="submit" class="btn btn-primary">Thêm</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>


                <section class="col-lg-6 connectedSortable">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                     @endif
                    <!-- TO DO List -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                QUYỀN TRUY CẬP
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-1">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Họ tên</th>
                                    <th>Quyền</th>
                                    <th>Chọn</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($show_user_roles as $key => $show_user_role)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $show_user_role->full_name }}</td>
                                    <td>
                                        @php($get_roles = DB::table('role_accesses')->where('id',$show_user_role->role_id)->get())
                                        @foreach($get_roles as $get_role)
                                            {{ $get_role->role_name }}
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($show_user_role->role_id == 1)
                                            <button class="btn btn-primary btn-sm" type="button" disabled>Thay đổi</>
                                        @else
                                            <a class="btn btn-primary btn-sm" href="{{ url('page-change-role/'.$show_user_role->id) }}" role="button">Thay đổi</a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            <b class="text-danger">Không có dữ liệu</b>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>


    <script>
        CKEDITOR.replace( 'inputDescript' );
    </script>

    <script>
        // Disable form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

@endsection
