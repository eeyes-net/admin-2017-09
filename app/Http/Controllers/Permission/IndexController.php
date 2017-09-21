<?php

namespace App\Http\Controllers\Permission;

use App\Http\Controllers\Controller;
use App\Model\Eeyes\Permission\User;

class IndexController extends Controller
{
    public function index()
    {
        return view('permission.index');
    }
}
