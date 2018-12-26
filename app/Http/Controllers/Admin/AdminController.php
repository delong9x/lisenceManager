<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Models\User;

class AdminController extends Controller
{
    protected  $ruleForm = [
        'email' => 'required|email|unique:users',
        'name' => 'required',
        'password' => 'required|min:6',
        'confirm_password' => 'required_with:password|same:password'
    ];

    public function index() {
        $listAdmin = User::orderBy('id', 'DESC')->paginate(20);
        return view(
            'admin.user.index',
            [
                'list' => $listAdmin
            ]
        );
    }

    public function create(Request $request, Response $response) {
        $user = new User();
        return view('admin.user.edit', ['data'=>$user]);
    }

    public function update($id, Request $request, Response $response) {
        $user = User::find($id);
        if (!$user) {
            return back()->with('error','Không tồn tại người dùng!');
        }
        return view('admin.user.edit', ['data'=>$user]);
    }

    public function saveNew(Request $request, Response $response) {
        $user = new User();
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $validator = Validator::make($request->all(), $this->ruleForm);
        if ($validator->fails())
        {
            return view('admin.user.edit', ['data'=>$user])->withErrors($validator);
            // The given data did not pass validation
        }
        $password = bcrypt($request->input('password'));
        $user->name = $request->input('name');
        $user->password = $password;
        $user->save();
        return redirect()->route('admin.user.update', ['id' => $user->id])->with('success', 'Tạo mới thành công');
    }

    public function store($id, Request $request, Response $response) {
        $user = User::find($id);
        if (!$user) {
            return back()->with('error','Không tồn tại người dùng!');
        }
        $rule = $this->ruleForm;
        unset($rule['email']);
        if (!$request->input('password') && !$request->input('confirm_password')) {
            unset($rule['password']);
            unset($rule['confirm_password']);
        }
        $validated = $request->validate($rule);
        $password = bcrypt($request->input('password'));
        $user->name = $request->input('name');
        $user->password = $password;
        $user->save();
        return back()->with('success','Cập nhật thành công!');

    }
}
