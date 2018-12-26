{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Danh sách người dùng</h1>
@stop

@section('content')
    <div class="box">
        <div class="box-header">
            <div class="pull-left">
                <a class="btn btn-block btn-primary" href="{{route('admin.user.create')}}">Tạo mới</a>
            </div>

            <div class="box-tools">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Họ và tên</th>
                    <th>Ngày Tạo</th>
                    <th>Thao Tác</th>
                </tr>
                @foreach ($list as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td><a href="{{route('admin.user.update', ['id'=>$item->id])}}">{{$item->email}}</a></td>
                        <td>{{$item->name}}</td>
                        <td>{{Carbon\Carbon::parse($item->createdAt)->format('d/m/Y')}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.user.update', ['id'=>$item->id])}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <span class="btn delete-btn btn-danger" data-id="{{$item->id}}">
                                <i class="fa fa-fw fa-close"></i>
                            </span>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $list->links() }}
        </div>
        <!-- /.box-body -->
    </div>
@stop


@section('js')
    <script>
        $('.delete-btn').click(function (e) {
            var id = $(this).data('id');
            url = '/api/user/' + id;
            if (confirm('Bạn có chắc chắn muốn xóa')) {
                $.ajax({
                    url: url,
                    type: 'DELETE'
                }).done(function (res) {
                    if (res) {
                        if (res.code && res.code != 200) {
                            alert(res.message);
                        } else {
                            alert('Xóa thành công!');
                            location.reload();
                        }
                    }

                })
            }
            return false;
        })
    </script>
@stop
