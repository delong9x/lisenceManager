{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Dashboard')

@section('content_header')
    <div class="box-header">
        <h1>@if($data->id) {{$data->email}} @else Tạo mới @endif</h1>
    </div>
@stop

@section('content')

    <form method="post">
        @csrf
        @if($data->id)
            @method('PUT')
        @endif
        @if (!$data->id)
            <div class="row">
                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label class="col-md-3 col-xs-6 col-sm-12">Email</label>
                    <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('email') ? 'has-error' : '' }}">
                        <input type="email" name="email" class="form-control" value="{{$data->email}}">
                    </div>
                    @if ($errors->has('email'))
                        <div class="col-md-5 col-xs-6 col-sm-12">
                         <span class="help-block">
                             <strong>{{ $errors->first('email') }}</strong>
                         </span>
                        </div>

                    @endif
                </div>
            </div>
        @endif
        <div class="row">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="col-md-3 col-xs-6 col-sm-12">Họ và tên</label>
                <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="text" name="name" class="form-control" value="{{$data->name}}">
                </div>
                @if ($errors->has('email'))
                    <div class="col-md-5 col-xs-6 col-sm-12">
                         <span class="help-block">
                             <strong>{{ $errors->first('name') }}</strong>
                         </span>
                    </div>

                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="col-md-3 col-xs-6 col-sm-12">Mật khẩu</label>
                <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control" value="">
                </div>
                @if ($errors->has('password'))
                    <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('password') }}</strong>
                     </span>
                    </div>

                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <label class="col-md-3 col-xs-6 col-sm-12">Xác nhận mật khẩu</label>
                <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('confirm_password') ? 'has-error' : '' }}">
                    <input type="password" name="confirm_password" class="form-control">
                </div>
                @if ($errors->has('confirm_password'))
                    <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('confirm_password') }}</strong>
                     </span>
                    </div>

                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input class="btn btn-success" type="submit" name="submit" value="Lưu">
                    <input class="btn btn-warning" type="reset" value="Làm lại">
                    <a class="btn btn-primary" href="{{route('admin.user.index')}}">Quay lại</a>
                </div>
            </div>
        </div>
    </form>


@stop


@section('js')
@stop
