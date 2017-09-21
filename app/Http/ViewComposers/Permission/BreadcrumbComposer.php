<?php

namespace App\Http\ViewComposers\Permission;

use Illuminate\Support\Str;
use Illuminate\View\View;

class BreadcrumbComposer
{
    public function compose(View $view)
    {
        $path = request()->path();
        $path_exploded = explode('/', $path);
        $breadcrumb = [
            ['url' => '/', 'name' => 'e瞳统一管理平台'],
            ['url' => '/permission', 'name' => 'e瞳统一权限管理'],
        ];
        if (isset($path_exploded[1])) {
            $names = [
                'permission' => '权限',
                'role' => '角色',
                'user' => '用户',
                'token' => '令牌',
            ];
            $breadcrumb[] = ['url' => '/permission/' . $path_exploded[1], 'name' => $names[$path_exploded[1]]];
            if (isset($path_exploded[2])) {
                if (Str::endsWith($path, 'create')) {
                    $breadcrumb[] = ['url' => $path, 'name' => '添加' . $names[$path_exploded[1]]];
                } elseif (Str::endsWith($path, 'edit')) {
                    $breadcrumb[] = ['url' => $path, 'name' => '编辑' . $names[$path_exploded[1]]];
                } else {
                    $breadcrumb[] = ['url' => $path, 'name' => '查看' . $names[$path_exploded[1]]];
                }
            }
        }
        $view->with(compact('breadcrumb'));
    }
}