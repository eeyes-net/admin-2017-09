<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Model\Eeyes\Permission\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permission.permission.index', [
            'items' => Permission::all(),
        ]);
    }

    public function create()
    {
        return view('permission.permission.edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|max:190|unique:mysql_permission.permissions',
        ]);
        $permission = new Permission();
        $permission->slug = $request->input('slug');
        $permission->name = $request->input('name');
        $permission->save();
        return back()->with([
            'success' => '权限' . $permission->slug . '已' . trans('resource.store'),
        ]);
    }

    public function show($id)
    {
        return Permission::find($id);
    }

    public function edit($id)
    {
        return view('permission.permission.edit', [
            'item' => Permission::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::find($id);
        $permission->slug = $request->input('slug');
        $permission->name = $request->input('name');
        $permission->save();
        return back()->with([
            'success' => '权限' . $permission->slug . '已' . trans('resource.update'),
        ]);
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);
        $permission->delete();
        return back()->with([
            'success' => '权限' . $permission->slug . '已' . trans('resource.destroy'),
        ]);
    }
}
