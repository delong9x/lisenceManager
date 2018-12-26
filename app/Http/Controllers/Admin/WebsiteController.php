<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Config;
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
        $baseUrl = Config::getConfigByKey('BASE_URL')->value;
        return view(
            'admin.website.index',
            [
                'list' => $listWebsite,
                'baseUrl' => $baseUrl
            ]
        );
    }

    public function create(Request $request, Response $response) {
        $web = new Website();
        return view('admin.website.edit', ['data'=>$web]);
    }

    public function update($id, Request $request, Response $response) {
        $web = Website::find($id);
        if (!$web) {
            return back()->with('error','Không tồn tại website!');
        }
        return view('admin.website.edit', ['data'=>$web]);
    }

    public function saveNew(Request $request, Response $response) {
        $web = new Website();
        $web->fill($request->all());
        $validator = Validator::make($request->all(), $this->ruleForm);
        if ($validator->fails())
        {
            return view('admin.website.edit', ['data'=>$web])->withErrors($validator);
            // The given data did not pass validation
        }
        $web->createdAt = Carbon::now();
        $web->updatedAt = Carbon::now();
        $web->save();
        return redirect()->route('admin.website.update', ['id' => $web->id])->with('success', 'Tạo mới thành công');
    }

    public function store($id, Request $request, Response $response) {
        $web = Website::find($id);
        if (!$web) {
            return back()->with('error','Không tồn tại website!');
        }

        $rule = $this->ruleForm;
        if ($request->input('main_color')) {
            $rule['main_color'] = 'color';
        }
        $rule['domain'] = $rule['domain']. ',domain,' . $id;
        $validated = $request->validate($rule);
        $web->fill($request->all());
        $web->user_id = Auth::id();
        $web->save();
        return back()->with('success','Cập nhật thành công!');

    }

}
