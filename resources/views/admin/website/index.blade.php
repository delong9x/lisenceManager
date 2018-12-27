{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('css')
@stop

@section('title', 'Dashboard')

@section('content_header')
    <h1>Danh sách website đã đăng ký</h1>
@stop

@section('content')
    <input type="hidden" id="base_url" value="{{$baseUrl}}">
    <div class="box">
        <div class="box-header">
            <div class="pull-left">
                <a class="btn btn-block btn-primary" href="{{route('admin.website.create')}}">Tạo mới</a>
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
                    <th>Tên miền</th>
                    <th>Email</th>
                    <th class="text-center">Số Điện Thoại</th>
                    <th class="text-center">Telegram Chat Id</th>
                    <th>Ngày đăng ký</th>
                    <th>Ngày hết hạn</th>
                    <th>Thao Tác</th>
                </tr>
                @foreach ($list as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td><a href="{{route('admin.website.update', ['id'=>$item->id])}}">{{$item->domain}}</a></td>
                        <td>{{$item->email}}</td>
                        <td class="text-center">{{$item->phone}}</td>
                        <td class="text-center">{{$item->chat_id}}</td>
                        <td>{{Carbon\Carbon::parse($item->createdAt)->format('d/m/Y')}}</td>
                        <td>{{Carbon\Carbon::parse($item->expire_date)->format('d/m/Y')}}</td>
                        <td>
                            <a class="btn btn-primary" href="{{route('admin.website.update', ['id'=>$item->id])}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-success popup-update-chat-id" data-id="{{$item->id}}">
                                <i class="fa fa-clock-o"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-success generate-code-chat" data-id="{{$item->id}}">
                                <i class="fa fa-file-code-o"></i>
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
    <!-- Modal -->
    <div class="modal fade" id="update-time-period-expire" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="update-time-period">
                <input id="current_website_id" type="hidden" name="current_website_id" value="">
                <div class="modal-content pull-left">
                    <div class="modal-header pull-left full-width">
                        <h3 class="modal-title" id="update-time-period-expire-label">Modal title</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pull-left full-width">
                        <div class="form-group row col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-4 col-sm-12 col-xs-12">Hạn hiện tại:</label>
                            <label class="col-md-4 col-sm-12 col-xs-12" id="current_enddate"></label>
                        </div>
                        <div class="form-group row col-md-12 col-sm-12 col-xs-12">
                            <label class="col-md-4 col-sm-12 col-xs-12">Thời gian thêm:</label>
                            <div class="col-md-2 col-sm-3 col-xs-3">
                                <input class="form-control" type="number" name="periodValue" min="0" value="0">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-6">
                                <select class="form-control" name="period">
                                    <option value="day">Ngày</option>
                                    <option value="month">Tháng</option>
                                    <option value="year">Năm</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pull-left full-width">
                        <input type="submit" class="btn btn-success btn-submit-popup pull-left" value="Cập nhật">
                        <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Đóng</button>
                    </div>
            </form>
        </div>
    </div>
    </div>

    <div class="modal fade" id="show-code-generated" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width: 800px">
            <form id="update-time-period">
                <div class="modal-content pull-left full-width">
                    <div class="modal-header pull-left full-width">
                        <a href="#" target="_blank"><h3 class="modal-title" id="generate-code-label">Modal title</h3>
                        </a>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body pull-left full-width">
                        <textarea id="code-generated-targeting" class="form-control disabled" rows="5"
                                  readonly></textarea>
                    </div>
                    <div class="modal-footer pull-left full-width">
                        <button id="copy-code-generated" type="button"
                                class="btn btn-success btn-submit-popup pull-left"
                                data-target="code-generated-targeting">Sao chép
                        </button>
                        <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Đóng</button>
                    </div>
            </form>
        </div>
    </div>
    </div>
@stop


@section('js')
    <script>
        $(function () {
            $('.popup-update-chat-id').click(function () {
                var id = $(this).data('id');
                var url = '/api/website/' + id;
                var data;
                var requestDetail = $.get(url).done(function (res) {
                    if (res.code != 200) {
                        alert(res.message);
                    } else {
                        data = res.data;
                        var expireDate = data.expire_date;
                        if (data.expire_date) {
                            expireDate = moment(expireDate).locale('vi').format('L');
                        } else {
                            expireDate = moment().locale('vi').format('L');
                        }


                        $('#update-time-period-expire-label').text(data.domain);
                        $('#current_enddate').text(expireDate);
                        $('#current_website_id').val(data.id);
                        $('#update-time-period-expire').modal('show');
                    }
                });

            })
            $('.generate-code-chat').click(function () {
                var id = $(this).data('id');
                var url = '/api/website/' + id;
                var data;
                var requestDetail = $.get(url).done(function (res) {
                    if (res.code != 200) {
                        alert(res.message);
                    } else {
                        data = res.data;
                        var textCode = '\n';
                        var baseUrl = $('#base_url').val();
                        if(baseUrl[baseUrl.length-1] === "/") {
                            baseUrl = baseUrl.substring(0, baseUrl.length-1);
                        }
                        textCode += '<script>\n';
                        textCode += '    window.destinationId = ' + data.chat_id + ';\n';
                        textCode += '    window.sourceServer = window.location.origin;\n';
                        textCode += '    window.intergramCustomizations = {\n';
                        if (data.title_closed) {
                            textCode += '        titleClosed: \'' + data.title_closed + '\',\n';
                        } else {
                            textCode += '        titleClosed: \'Liên hệ\',\n';
                        }

                        if (data.title_open) {
                            textCode += '        titleOpen: \'' + data.title_open + '\',\n';
                        } else {
                            textCode += '        titleOpen: \'Liên hệ\',\n';
                        }

                        if (data.intro_message) {
                            textCode += '        introMessage: \'' + data.intro_message + '\',\n';
                        } else {
                            textCode += '        introMessage: \'Xin chào, chúng tôi có thể giúp gì cho bạn?\',\n';
                        }

                        if (data.placeholder_text) {
                            textCode += '        placeholderText: \'' + data.placeholder_text + '\',\n';
                        } else {
                            textCode += '        placeholderText: \'Gửi tin nhắn...\',\n';
                        }

                        if (data.auto_response) {
                            textCode += '        autoResponse: \'' + data.auto_response + '\',\n';
                        } else {
                            textCode += '        autoResponse: \'Đang kết nối tới tổng đài, xin vui lòng chờ trong giây lát\',\n';
                        }

                        if (data.auto_no_response) {
                            textCode += '        autoNoResponse: \'' + data.auto_no_response + '\',\n';
                        } else {
                            textCode += '        autoNoResponse: \'Hiện tại đang không có nhân viên trực, xin vui lòng liên hệ lại sau!\',\n';
                        }

                        if (data.main_color) {
                            textCode += '        mainColor: "' + data.main_color + '", // Can be any css supported color \'red\', \'rgb(255,87,34)\', etc\n';
                        } else {
                            textCode += '        mainColor: "#42659e", // Can be any css supported color \'red\', \'rgb(255,87,34)\', etc\n';
                        }

                        if (data.get_customer_info_text) {
                            textCode += '        getCustomerInfoText: \'' + data.auto_no_response + '\',\n';
                        } else {
                            textCode += '        getCustomerInfoText: \'Xin vui lòng nhập thông tin của bạn để chúng tôi liên hệ!\',\n';
                        }
                        if ($('#base_url').val()) {
                            textCode += '        requestServer: \'' + baseUrl + '\',\n';
                        }

                        textCode += '        alwaysUseFloatingButton: false // Use the mobile floating button also on large screens\n';
                        textCode += '     };\n';
                        textCode += '<\/script>\n';
                        textCode += '<script src="' + $('#base_url').val() + 'js/widget.js"><\/script>\n';
                        $('#code-generated-targeting').text(textCode);
                        $('#show-code-generated').modal('show');
                    }
                });
            })
            $('#copy-code-generated').click(function () {
                var copyText = $('#code-generated-targeting');
                copyText.select();
                document.execCommand("copy");
                $.notify('Đã sao chép', {
                    className: 'success',
                    globalPosition: 'bottom right'
                })
            })
        })

        $('#update-time-period').submit(function (e) {
            e.preventDefault();
            data = getFormData($(this));
            url = '/api/website/' + data.current_website_id;
            if (data.periodValue <= 0) {
                alert('Dữ liệu thêm không đúng');
            } else {
                if (confirm('Bạn có chắc chắn muốn cập nhật')) {
                    $('.btn-submit-popup').addClass('disabled');
                    $.ajax({
                        url: url,
                        type: 'PUT',
                        data: data,
                        dataType: 'json'
                    }).done(function (res) {
                        if (res) {
                            if (res.code && res.code != 200) {
                                $('.btn-submit-popup').removeClass('disabled');
                                alert(res.message);
                            } else {
                                alert('Cập nhật thành công!');
                                location.reload();
                            }
                        }

                    })
                }
            }
            return false;
        })

        $('.delete-btn').click(function (e) {
            var id = $(this).data('id');
            url = '/api/website/' + id;
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
