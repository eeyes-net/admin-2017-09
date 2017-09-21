@extends('permission.layouts.master')

@section('main')
    <?php $is_update = isset($item); ?>
    <h2>{{ $is_update ? '编辑' : '添加' }}用户</h2>
    <div class="container">
        <form method="POST" action="{{ $is_update ? action('Permission\UserController@update', ['id' => $item->id]) : action('Permission\UserController@store') }}">
            {{ method_field($is_update ? 'PUT' : 'POST') }}
            {{ csrf_field() }}
            @if($is_update)
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">#</label>
                    <div class="col-sm-10">
                        <input type="text" readonly class="form-control-plaintext" value="{{ $item->id }}">
                    </div>
                </div>
            @endif
            <div class="form-group row">
                <label for="form-control-username" class="col-sm-2 col-form-label">用户名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="username" id="form-control-username" placeholder="NetId" @if($is_update) value="{{ $item->username }}" @endif>
                </div>
            </div>
            <div class="form-group row">
                <label for="form-control-name" class="col-sm-2 col-form-label">姓名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" id="form-control-name" placeholder="姓名" @if($is_update) value="{{ $item->name }}" @endif>
                </div>
            </div>
            <div class="form-group row">
                <label for="form-control-name" class="col-sm-2 col-form-label">角色</label>
                <div class="col-sm-10">
                    @include('permission.user.layouts.roles')
                </div>
            </div>
            @if($is_update)
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
            @endif
            <button type="submit" class="btn btn-primary">{{ $is_update ? '保存' : '添加' }}</button>
        </form>
    </div>
@stop