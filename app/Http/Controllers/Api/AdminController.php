<?php

namespace App\Http\Controllers\Api;

use App\Http\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function delete($id, Request $request, Response $response) {
        $admin = User::find($id);
        $rsp = [
            'code' => 400,
            'message' => 'Không tồn tại tài khoản',
            'data' => []
        ];
        if ($admin) {
            if (count(User::all()) == 1) {
                $rsp['message'] = 'Không thể xóa tài khoản quản lý cuối cùng';
            } else {
                if ($admin->id == Auth::id()) {
                    $rsp['message'] = 'Không thể tự xóa tài khoản của mình';
                } else {
                    if($admin->delete()) {
                        $rsp['code'] = 200;
                        $rsp['message'] = 'Xóa thành công';
                    } else {
                        $rsp['message'] = 'Có lỗi trong quá trình thao tác, xin vui lòng thử lại sau';
                    }
                }
            }

        }


        return response()->json($rsp);
    }


}
