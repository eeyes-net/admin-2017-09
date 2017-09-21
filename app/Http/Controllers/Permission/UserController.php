<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Library\Eeyes\Api\XjtuUserInfo;
use App\Model\Eeyes\Permission\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('permission.user.index', [
            'items' => User::all(),
        ]);
    }

    public function create()
    {
        return view('permission.user.edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|max:190|unique:mysql_permission.users',
            'role.*' => 'numeric',
        ]);
        $user = new User();
        $user->username = $request->input('username');
        $user->password = '*';
        $user->name = $request->input('name') ?: XjtuUserInfo::getByNetId($user->username)['username'];
        $user->save();
        $user->roles()->sync(array_values($request->input('roles', [])));
        return back()->with([
            'success' => '用户' . $user->username . '已' . trans('resource.store'),
        ]);
    }

    public function show($id)
    {
        return view('permission.user.show', [
            'item' => User::find($id),
        ]);
    }

    public function edit($id)
    {
        return view('permission.user.edit', [
            'item' => User::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|max:190',
            'role.*' => 'numeric',
        ]);
        $user = User::find($id);
        $user->username = $request->input('username');
        $user->password = '*';
        $user->name = $request->input('name') ?: XjtuUserInfo::getByNetId($user->username)['username'];
        $user->save();
        $roles = array_values($request->input('roles', []));
        $user->roles()->sync($roles);
        return back()->with([
            'success' => '用户' . $user->username . '已' . trans('resource.update'),
        ]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with([
            'success' => '用户' . $user->username . '已' . trans('resource.destroy'),
        ]);
    }
}
