<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller as BaseController;

class UserController extends BaseController
{
    function index(): string
    {
        return 'dashboard user';
    }

    function search(string $user_name, string $user_phone, $user_type = '전체'): string
    {
        return "dashboard user_name {$user_name}, user_phone {$user_phone}, user_type {$user_type}";
    }
}
