@extends('permission.layouts.master')

@section('main')
    <h2>令牌 <a class="btn btn-outline-primary" href="{{ action('Permission\TokenController@create') }}">新建</a></h2>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>令牌</th>
                    <th>名称</th>
                    <th>角色</th>
                    <th>生效时间</th>
                    <th>过期时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->token }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @foreach($item->roles as $role)
                                <span class="badge badge-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ (new \Carbon\Carbon($item->not_before))->diffForHumans() }}</td>
                        <td>{{ (new \Carbon\Carbon($item->not_after))->diffForHumans() }}</td>
                        <td>
                            <a class="btn btn-outline-primary" href="{{ action('Permission\TokenController@show', ['id' => $item->id]) }}">查看</a>
                            <a class="btn btn-outline-primary" href="{{ action('Permission\TokenController@edit', ['id' => $item->id]) }}">编辑</a>
                            <a class="btn btn-danger" href="javascript:destroy({{ $item->id }});void 0;">删除</a>
                            <form class="form-destroy" data-id="{{ $item->id }}" method="POST" action="{{ action('Permission\TokenController@destroy', ['id' => $item->id]) }}">
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