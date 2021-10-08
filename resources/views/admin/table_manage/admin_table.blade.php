@extends('admin.table_manage.layout_admin_table')
@section('content_table')
    <div class="col-md-6" id="table-list">
        <div class="row list-filter">
            <div class="col-md list-filter-content" style="margin-left: 40px;">
                <a class="btn btn-primary" href="{{ url('admin-table/0') }}" role="button">Tất Cả</a>
                @foreach ($show_areas as $show_area)
                    <a class="btn btn-primary" href="{{ url('admin-table/'.$show_area->id) }}" role="button">
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
                                <a href="{{ url('talbe-cart/'.$show_table->id) }}" style="color: #fff;">
                                    {{ $show_table->table_name }}
                                </a>
                            </li>
                        @else	
                            <li style="background-color: #ff5823;">
                                <a href="{{ url('talbe-cart/'.$show_table->id) }}" style="color: #fff;">
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