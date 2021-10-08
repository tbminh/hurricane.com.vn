@extends('layout.layout_admin')
@section('title', 'Trang thay đổi quyền truy cập')


@section('breadcrumb')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('page-role-access') }}">Quyền truy cập</a></li>
                        <li class="breadcrumb-item active">Thay đổi quyền truy cập</li>
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
                <!-- Left col -->
                <section class="col-lg-6 offset-lg-3">
                    <!-- TO DO List -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                THAY ĐỔI QUYỀN
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-1">
                            <form action="{{ url('update-role/'.$role_ids->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label>Tên người</label>
                                        <input type="text" class="form-control" name="inputName" id="inputName"
                                        value="{{ $role_ids->full_name }}" disabled>
                                    </div>

                                    <div class="col-sm-6">
                                        <label>Quyền</label>
                                        <select name="inputRoleId" class="form-control">
                                            @php($get_roles = DB::table('role_accesses')->where('id',$role_ids->role_id)->get())
                                            @foreach($get_roles as $get_role)
                                                <option value="{{ $get_role->id }}">{{ $get_role->role_name }}</option>
                                            @endforeach

                                            <option value="">- - Chọn quyền - -</option>
                                            @php($get_role_2 = DB::table('role_accesses')->get())
                                            @foreach($get_role_2 as $data)
                                                <option value="{{ $data->id }}">{{ $data->role_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10 text-right">
                                        <button type="submit" class="btn btn-primary">Thay đổi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
            </div>
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
