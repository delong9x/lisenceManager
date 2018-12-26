<?php

namespace App\Http\Controllers\Admin;

use App\Http\Models\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    //
    protected  $ruleForm = [
        'ALLOW_ALL' => 'required',
        'BASE_URL' => 'required|url'
    ];

    protected $ruleMessages = [
        'ALLOW_ALL.required' => 'Không đúng kiểu dữ liệu',
        'BASE_URL.url' =>'Đường dẫn không đúng',
        'BASE_URL.required' =>'Bắt buộc phải điền'
    ];

    public function index() {
        $listConfig = Config::getAllConfig();
        return view(
            'admin.config.index',
            ['list' => $listConfig]
        );
    }

    public function store(Request $request) {
        $listConfig = Config::getAllConfig();
        foreach($listConfig as $key => $config) {
            $listConfig[$key]->value = $request->input($config->key);
        }
        $validator = Validator::make($request->all(), $this->ruleForm, $this->ruleMessages);
        if ($validator->fails())
        {
            return view('admin.config.index', ['list'=>$listConfig])->withErrors($validator);
            // The given data did not pass validation
        }
        foreach($listConfig as $key => $config) {
            $config->save();
        }
        return redirect()->route('admin.config.index')->with('success', 'Cập nhật thành công');
    }
}
