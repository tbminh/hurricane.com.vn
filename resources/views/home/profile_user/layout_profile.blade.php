@extends('layout.layout')
@section('title', 'Hồ sơ cá nhân')

{{--  ===============================================  --}}
@section('link_css')
<link rel="stylesheet" href="{{ url('public/home/css/style_profile_user.css') }}">
@endsection
{{--  ===============================================  --}}

<style>
    table thead tr th{
        text-align: center;
    }

    table tbody tr td{
        text-align: center;
    }
    .list-group{
            display: none;
        }
        .tabbable .nav-tabs{
            display: inline-block;
            margin-bottom: 10px;
        }
</style>
{{--  ===============================================  --}}
@section('content')

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <br>
                <div id="user-profile-2" class="user-profile">
                    <div class="tabbable">
                        <ul class="nav nav-tabs padding-0">
                            <li>
                                <a href="{{ url('page-profile') }}">
                                    <i class="green ace-icon fa fa-user bigger-120"></i>
                                    Hồ sơ cá nhân
                                </a>
                            </li>
                            @php($count_wait = DB::table('orders')->where([['user_id',Auth::id()], ['order_status', 0]])->count())
                            @php($count_ship = DB::table('orders')->where([['user_id',Auth::id()], ['order_status', 1]])->count())
                            
                            <li>
                                @if($count_wait > 0)
                                    <a href="{{ url('page-wait-payment/'.Auth::id()) }}">
                                        <i class="orange ace-icon fa fa-cc-mastercard bigger-120"></i>
                                        Chờ xác nhận ({{ $count_wait }})
                                    </a>
                                @else
                                    <a href="{{ url('page-wait-payment/'.Auth::id()) }}">
                                        <i class="orange ace-icon fa fa-cc-mastercard bigger-120"></i>
                                        Chờ xác nhận
                                    </a> 
                                @endif       
                            </li>

                            <li>
                                @if($count_ship > 0)
                                    <a href="{{ url('page-shipping/'.Auth::id()) }}">
                                        <i class="orange ace-icon fa fa-cc-mastercard bigger-120"></i>
                                        Đang giao hàng ({{ $count_ship }})
                                    </a>
                                @else
                                    <a href="{{ url('page-shipping/'.Auth::id()) }}">
                                        <i class="orange ace-icon fa fa-car bigger-120"></i>
                                        Đang giao hàng
                                    </a>
                                @endif
                            </li>

                            <li>
                                <a href="{{ url('page-complete/'.Auth::id()) }}">
                                    <i class="orange ace-icon fa fa-car bigger-120"></i>
                                    Đã giao
                                </a>
                            </li>

                            <li>
                                <a href="{{ url('page-cancelled/'.Auth::id()) }}">
                                    <i class="pink ace-icon fa fa-close bigger-120"></i>
                                    Đã hủy
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content no-border padding-0"><br>
                            <div id="home" class="tab-pane in active">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3 center">
                                        <span class="profile-picture">
                                            <img class="editable img-responsive" alt="Avatar" id="avatar2 "
                                            src="{{url('public/home/upload_img/'.Auth::user()->avatar)}}" width="250" height="250">
                                        </span>

                                        <div class="space space-4"></div>

                                        <a href="{{ url('page-edit-user/'.Auth::id()) }}" class="btn btn-info btn-block">
                                            <i class="fa fa-info-circle"></i> <b>Cập nhật thông tin</b>
                                        </a>

                                        <a href="{{ url('page-change-password') }}" class="btn btn-warning btn-block">
                                            <i class="fa fa-key"></i><b> Đổi mật khẩu</b>
                                        </a>
                                        <br>
                                    </div>
                                    <!-- /.col -->

                                    <div class="col-xs-12 col-sm-9">

                                        {{--  Thừa kế từ layout-profile-user  --}}
                                        @yield('content-profile-col-9')
                                        {{--  Thừa kế từ layout-profile-user  --}}

                                    </div><!-- /.col -->
                                </div><!-- /.row -->

                                <div class="space-20"></div>

                            </div>
                            <!-- /#home -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
