@extends('order_table.layout_table')
@section('title','Trang chọn bàn')

<div class="header-cashier">
    <div class="container-fluid">
        <div class="row ft-tabs">
            <div class="col-md-3">
                <ul class="tabs-list">
                    <li><a href="{{ url('table-manage/0') }}" data="listtable" class="active">Phòng Bàn</a></li>
                    <li><a href="{{ url('table-menu/0/0') }}" data="pos">Thực đơn</a></li>
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
<div class="col-md-6" id="table-list">
    <div class="row list-filter">
        <div class="col-md list-filter-content" style="margin-left: 40px;">
            <a class="btn btn-primary" href="{{ url('table-manage/0') }}" role="button">Tất Cả</a>
            @foreach ($show_areas as $show_area)
                <a class="btn btn-primary" href="{{ url('table-manage/'.$show_area->id) }}" role="button">
                    {{ $show_area->area_name }}
                </a>
            @endforeach
        </div>
    </div>
    <div class="row table-list">
        <div class="col-md table-list-content">
            <ul>
                @foreach($show_tables as $show_table)	
                    @if ($show_table->table_status == 0)
                        <li>
                            <a href="{{ url('table-menu/'.$show_table->id.'/'.'0') }}" style="color: #fff;" title="Nhấp để chọn món">
                                {{ $show_table->table_name }}
                            </a>
                        </li>
                    @else	
                        <li style="background-color: #ff5823;">
                            <a href="{{ url('table-menu/'.$show_table->id.'/'.'0') }}" style="color: #fff;" title="Nhấp để chọn món">
                                {{ $show_table->table_name }}
                            </a>
                        </li>
                    @endif
                @endforeach   
            </ul>
        </div>
    </div>
</div>

@endsection