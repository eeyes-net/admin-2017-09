<?php

namespace App\Http\ViewComposers\Permission;

use Illuminate\Support\Str;
use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view)
    {
        $path = request()->path();
        $sidebar_active = [
            'index' => ($path === 'permission'),
            'permission' => Str::startsWith($path, 'permission/permission'),
            'role' => Str::startsWith($path, 'permission/role'),
            'user' => Str::startsWith($path, 'permission/user'),
            'token' => Str::startsWith($path, 'permission/token'),
        ];
        foreach ($sidebar_active as &$item) {
            $item = $item ? 'active' : '';
        }
        $view->with(compact('sidebar_active'));
    }
}