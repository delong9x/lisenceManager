{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cấu hình chung</h1>
@stop

@section('content')
    <form action="{{route('admin.config.store')}}" method="post">
        @csrf
        @method('PUT')

    @foreach($list as $option)
        @include('common.form', $option)
    @endforeach
        <div class="row">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input class="btn btn-success" type="submit" name="submit" value="Lưu">
                    <input class="btn btn-warning" type="reset" value="Làm lại">
                </div>
            </div>
        </div>
    </form>
@stop


@section('js')
@stop
