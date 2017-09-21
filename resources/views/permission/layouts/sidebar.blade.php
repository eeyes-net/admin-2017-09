<nav class="col-sm-3 col-md-2 bg-light sidebar">
    <ul class="nav nav-pills flex-column">
        <li class="nav-item">
            <a class="nav-link {{ $sidebar_active['index'] }}" href="{{ action('Permission\IndexController@index') }}">主页 <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $sidebar_active['permission'] }}" href="{{ action('Permission\PermissionController@index') }}">权限</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $sidebar_active['role'] }}" href="{{ action('Permission\RoleController@index') }}">角色</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $sidebar_active['user'] }}" href="{{ action('Permission\UserController@index') }}">用户</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $sidebar_active['token'] }}" href="{{ action('Permission\TokenController@index') }}">令牌</a>
        </li>
    </ul>
</nav>
