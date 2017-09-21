# e瞳统一管理平台

<https://admin.eeyes.net/>

提供e瞳一些内部网站统一管理服务

## 部署

1. 解压到服务器
2. `chmod 777 -R storage/ bootstrap/cache/`
3. `cp .env.example .env`并修改`.env`中的数据库信息和API信息
4. `composer install`
5. `php artisan key:generate`

## 说明

* 基于`Laravel 5.5`开发
* 使用CAS登录和e瞳统一API验证权限，本地无用户表。

## LICENSE

    The MIT License (MIT)
    
    Copyright (c) 2017 eeyes.net
    
    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:
    
    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

