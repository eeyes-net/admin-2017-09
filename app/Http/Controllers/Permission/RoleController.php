<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Model\Eeyes\Permission\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('permission.role.index', [
            'items' => Role::all(),
        ]);
    }

    public function create()
    {
        return view('permission.role.edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|max:190|unique:mysql_permission.roles',
            'permission.*' => 'numeric',
        ]);
        $item = new Role();
        $item->slug = $request->input('slug');
        $item->name = $request->input('name');
        $item->save();
        $item->permissions()->sync(array_values($request->input('permissions', [])));
        $item->extend_roles()->sync(array_values($request->input('roles', [])));
        return back()->with([
            'success' => '角色' . $item->slug . '已' . trans('resource.store'),
        ]);
    }

    public function show($id)
    {
        return view('permission.role.show', [
            'item' => Role::find($id),
        ]);
    }

    public function edit($id)
    {
        return view('permission.role.edit', [
            'item' => Role::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'slug' => 'required|max:190',
            'permission.*' => 'numeric',
        ]);
        $item = Role::find($id);
        $item->slug = $request->input('slug');
        $item->name = $request->input('name');
        $item->save();
        $item->permissions()->sync(array_values($request->input('permissions', [])));
        $item->extend_roles()->sync(array_values($request->input('roles', [])));
        return back()->with([
            'success' => '角色' . $item->slug . '已' . trans('resource.update'),
        ]);
    }

    public function destroy($id)
    {
        $item = Role::find($id);
        $item->delete();
        return back()->with([
            'success' => '角色' . $item->slug . '已' . trans('resource.destroy'),
        ]);
    }
}
