<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Models\Website;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{

    protected  $ruleForm = [
        'domain' => 'required|unique:websites',
        'email' => 'required|email',
        'chat_id' => 'required'

    ];

    public function index() {
        $listWebsite = Website::orderBy('id', 'DESC')->paginate(20);
        return view(
            'admin.website.index',
            ['list' => $listWebsite]
        );
    }

    public function getDetail($id, Request $request, Response $response) {
        $web = Website::find($id);
        $rsp = [
            'code' => 400,
            'message' => 'Không tồn tại website',
            'data' => []
        ];
        if ($web) {
            $rsp = [
                'code' => 200,
                'message' => 'Lấy thông tin thành công',
                'data' => $web
            ];
        }
        return response()->json($rsp);

    }

    public function updateToken($id, Request $request, Response $response) {
        $web = Website::find($id);
        $rsp = [
            'code' => 400,
            'message' => 'Không tồn tại website',
            'data' => []
        ];
        if (!$web) {
            return response()->json($rsp);
        }
        if ($web->expire_date && Carbon::parse($web->expire_date) <= Carbon::now()) {
            $startDate = Carbon::parse($web->start_date);
        } else {
            $startDate = Carbon::now();
        }

        $expirePeriod = $request->input('period');
        $expirePeriodNumber = $request->input('periodValue');
        $endDate = $startDate;
        switch ($expirePeriod) {
            case 'day':
                $endDate = $startDate->addDays($expirePeriodNumber);
                break;
            case 'month':
                $endDate = $startDate->addMonths($expirePeriodNumber);
                break;
            case 'year':
                $endDate = $startDate->addYears($expirePeriodNumber);
                break;
        }
        $web->start_date = $startDate;
        $web->expire_date = $endDate;
        $web->save();
        $rsp['code'] = 200;
        $rsp['message'] = 'Cập nhật thành công';
        $rsp['data'] = [
            'expire_date' => $endDate,
            'start_date' => $startDate
        ];
        return response()->json($rsp);
    }

    public function delete($id, Request $request, Response $response) {
        $web = Website::find($id);
        $rsp = [
            'code' => 400,
            'message' => 'Không tồn tại website',
            'data' => []
        ];
        if ($web) {
            if($web->delete()) {
                $rsp['code'] = 200;
                $rsp['message'] = 'Xóa thành công';
            } else {
                $rsp['message'] = 'Có lỗi trong quá trình thao tác, xin vui lòng thử lại sau';
            }
        }


        return response()->json($rsp);
    }


}
