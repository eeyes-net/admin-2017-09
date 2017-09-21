@extends('permission.layouts.master')

@section('main')
    <h2>用户 <a class="btn btn-outline-primary" href="{{ action('Permission\UserController@create') }}">新建</a></h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>用户名</th>
                    <th>名称</th>
                    <th>角色</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @foreach($item->roles as $role)
                                <span class="badge badge-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a class="btn btn-outline-primary" href="{{ action('Permission\UserController@show', ['id' => $item->id]) }}">查看</a>
                            <a class="btn btn-outline-primary" href="{{ action('Permission\UserController@edit', ['id' => $item->id]) }}">编辑</a>
                            <a class="btn btn-danger" href="javascript:destroy({{ $item->id }});void 0;">删除</a>
                            <form class="form-destroy" data-id="{{ $item->id }}" method="POST" action="{{ action('Permission\UserController@destroy', ['id' => $item->id]) }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include('permission.layouts.destroy_script')
@stop