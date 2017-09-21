<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Model\Eeyes\Permission\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function index()
    {
        return view('permission.token.index', [
            'items' => Token::all(),
        ]);
    }

    public function create()
    {
        return view('permission.token.edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'token' => 'required|max:190|unique:mysql_permission.tokens',
        ]);
        $token = new Token();
        $token->token = $request->input('token');
        $token->name = $request->input('name');
        $token->description = $request->input('description');
        $token->not_before = $request->input('not_before') ?: Carbon::now()->toDateTimeString();
        $token->not_after = $request->input('not_after') ?: Carbon::parse('+3 months')->toDateTimeString();
        $token->save();
        $token->roles()->sync(array_values($request->input('roles', [])));
        return back()->with([
            'success' => '令牌' . $token->token . '已' . trans('resource.store'),
        ]);
    }

    public function show($id)
    {
        return view('permission.token.show', [
            'item' => Token::find($id),
        ]);
    }

    public function edit($id)
    {
        return view('permission.token.edit', [
            'item' => Token::find($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $token = Token::find($id);
        $token->token = $request->input('token');
        $token->name = $request->input('name');
        $token->description = $request->input('description');
        $token->not_before = $request->input('not_before') ?: Carbon::now()->toDateTimeString();
        $token->not_after = $request->input('not_after') ?: Carbon::parse('+3 months')->toDateTimeString();
        $token->save();
        $token->roles()->sync(array_values($request->input('roles', [])));
        return back()->with([
            'success' => '令牌' . $token->token . '已' . trans('resource.update'),
        ]);
    }

    public function destroy($id)
    {
        $token = Token::find($id);
        $token->delete();
        return back()->with([
            'success' => '令牌' . $token->token . '已' . trans('resource.destroy'),
        ]);
    }
}
