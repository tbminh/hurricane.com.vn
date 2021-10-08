@extends('layout.layout')
@section('title','Trang Đặt Bàn')
@section('content')

<link rel="stylesheet" href="{{ asset('public/home/css/table.css') }}" type="text/css">

<div class="plane">
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
            <a href="#" style="margin-left: 50px;">TẦNG 1</a>
            <a href="#" style="margin-left: 150px;">TẦNG 2</a>
                {{-- <ol class="seats" type="A">
                    @foreach($show_tables as $show_table)
                        @if($show_table->area_id == 1)
                            <li class="seat">
                                <input type="checkbox" id="{{ $show_table->id }}" name="inputTable" value="{{ $show_table->table_name }}"/>
                                <label for="{{ $show_table->id }}">{{ $show_table->table_name }}</label>
                            </li>
                    @endforeach  
                </ol> --}}
                <ol class="seats" type="A">
                    <li class="seat">
                        <input type="checkbox" id="11" name="A01" value="A02"/>
                        <label for="11">A01</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="12" name="A02" value="A02"/>
                        <label for="12">A02</label>
                    </li>
                    <li class="seat" >
                        <input type="checkbox" id="13" name="A03" value="A03"/>
                        <label for="13">A03</label>
                    </li>
                    <li class="seat" style="width:67.50px;padding:5px;">
                        <input type="checkbox"  id="14"name="B01" value="B01" />
                        <label for="14" style="">B01</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="15" name="B02" value="B02"/>
                        <label for="15">B02</label>
                    </li>
                    <li class="seat">
                        <input type="checkbox" id="16" name="B03" value="B03"/>
                        <label for="16">B03</label>
                    </li>
                </ol>
              
        <input  type="submit" value="Submit" name="submit"  class="btn btn-success">
    </form>
</div>
@endsection