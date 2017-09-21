@extends('permission.layouts.master')

@section('main')
    <h2>权限 <a class="btn btn-outline-primary" href="{{ action('Permission\PermissionController@create') }}">新建</a></h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>代号</th>
                    <th>名称</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->slug }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a class="btn btn-outline-primary" href="{{ action('Permission\PermissionController@edit', ['id' => $item->id]) }}">编辑</a>
                            <a class="btn btn-danger" href="javascript:destory({{ $item->id }});void 0;">删除</a>
                            <form class="form-destroy" data-id="{{ $item->id }}" method="POST" action="{{ action('Permission\PermissionController@destroy', ['id' => $item->id]) }}">
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