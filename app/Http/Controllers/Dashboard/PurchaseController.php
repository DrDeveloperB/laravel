<?php
namespace App\Http\Controllers\Dashboard;

use Illuminate\Routing\Controller as BaseController;

class PurchaseController extends BaseController
{
    function index(): string
    {
        return 'dashboard purchase';
    }

    function search(int $order_num, string $user_name, $goods_name = '기본상품'): string
    {
        return "dashboard order_num {$order_num}, user_name {$user_name}, goods_name {$goods_name}";
    }
}
