{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Dashboard')

@section('content_header')
    <div class="box-header">
        <h1>@if($data->id) {{$data->domain}} @else Tạo mới @endif</h1>
    </div>
@stop

@section('content')

<form method="post">
    @csrf
    @if($data->id)
        @method('PUT')
    @endif

    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Tên Miền</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('domain') ? 'has-error' : '' }}">
                <input type="text" name="domain" class="form-control" value="{{$data->domain}}">
            </div>
            @if ($errors->has('domain'))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('domain') }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Email*</label>
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
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Số điện thoại</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('phone') ? 'has-error' : '' }}">
                <input type="text" name="phone" class="form-control" value="{{$data->phone}}">
            </div>
            @if ($errors->has('phone'))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('phone') }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Telegeram Id*</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('chat_id') ? 'has-error' : '' }}">
                <input type="text" name="chat_id" class="form-control" value="{{$data->chat_id}}">
            </div>
            @if ($errors->has('chat_id'))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('chat_id') }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Tiêu đề khi đóng:</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('title_closed') ? 'has-error' : '' }}">
                <input type="text" name="title_closed" class="form-control" value="{{$data->title_closed}}">
            </div>
            @if ($errors->has('title_closed'))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('title_closed') }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Tiêu đề khi đang chat:</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('title_open') ? 'has-error' : '' }}">
                <input type="text" name="title_open" class="form-control" value="{{$data->title_open}}">
            </div>
            @if ($errors->has('title_open'))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('title_open') }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Lời chào:</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('intro_message') ? 'has-error' : '' }}">
                <input type="text" name="intro_message" class="form-control" value="{{$data->intro_message}}">
            </div>
            @if ($errors->has('intro_message'))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('intro_message') }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Tự động trả lời:</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('auto_response') ? 'has-error' : '' }}">
                <input type="text" name="auto_response" class="form-control" value="{{$data->auto_response}}">
            </div>
            @if ($errors->has('auto_response'))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('auto_response') }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Tự động trả lời khi không phản hồi:</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('auto_no_response') ? 'has-error' : '' }}">
                <input type="text" name="auto_no_response" class="form-control" value="{{$data->auto_no_response}}">
            </div>
            @if ($errors->has('auto_no_response'))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('auto_no_response') }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Gợi ý khi chat:</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('placeholder_text') ? 'has-error' : '' }}">
                <input type="text" name="placeholder_text" class="form-control" value="{{$data->placeholder_text}}">
            </div>
            @if ($errors->has('placeholder_text'))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('placeholder_text') }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Đề nghị nhập thông tin cá nhân:</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('get_customer_info_text') ? 'has-error' : '' }}">
                <input type="text" name="get_customer_info_text" class="form-control" value="{{$data->get_customer_info_text}}">
            </div>
            @if ($errors->has('get_customer_info_text'))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('get_customer_info_text') }}</strong>
                     </span>
                </div>

            @endif
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-3 col-xs-6 col-sm-12">Màu chủ đạo:</label>
            <div class="col-md-4 col-xs-6 col-sm-12 {{ $errors->has('main_color') ? 'has-error' : '' }}">
                <div class="input-group colorpicker-component my-colorpicker1">
                    <input type="text" name="main_color" class="form-control " value="{{$data->main_color}}">
                    <span class="input-group-addon"><i></i></span>
                </div>
            </div>
            @if ($errors->has('main_color'))
                <div class="col-md-5 col-xs-6 col-sm-12">
                     <span class="help-block">
                         <strong>{{ $errors->first('main_color') }}</strong>
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
                <a class="btn btn-primary" href="{{route('admin.website.index')}}">Quay lại</a>
            </div>
        </div>
    </div>
</form>


@stop


@section('js')
    <script>
        $(function () {
            $('.my-colorpicker1').colorpicker();
        })
    </script>
@stop
