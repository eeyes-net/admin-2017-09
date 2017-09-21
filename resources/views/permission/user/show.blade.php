@extends('permission.layouts.master')

@section('main')
    <?php $is_update = isset($item); ?>
    <h2>查看用户 <a class="btn btn-outline-primary" href="{{ action('Permission\UserController@edit', ['id' => $item->id]) }}">编辑</a></h2>
    <div class="container">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">#</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="{{ $item->id }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">用户名</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="{{ $item->username }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">姓名</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="{{ $item->name }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="form-control-name" class="col-sm-2 col-form-label">角色</label>
            <div class="col-sm-10">
                @foreach($item->roles as $role)
                    <span class="badge badge-primary" title="{{ $role->slug }}">{{ $role->name }}</span>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label for="form-control-name" class="col-sm-2 col-form-label">权限</label>
            <div class="col-sm-10">
                @foreach($item->all_permissions as $permission)
                    <span class="badge badge-primary" title="{{ $permission->slug }}">{{ $permission->name }}</span>
                @endforeach
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">创建时间</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="{{ $item->created_at }}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">修改时间</label>
            <div class="col-sm-10">
                <input type="text" readonly class="form-control-plaintext" value="{{ $item->updated_at }}">
            </div>
        </div>
    </div>
@stop