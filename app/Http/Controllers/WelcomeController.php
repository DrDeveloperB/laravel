<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class WelcomeController extends BaseController
{
    function index()
    {
        echo "<xmp>";
        print_r('hello index');
        echo "</xmp>";

        return view('hello');
    }

    function post()
    {
        return 'welcome post';
    }

    function users($id)
    {
        return $id;
    }

    function prefix1()
    {
        return 'welcome prefix1';
    }

    function prefix2()
    {
        return 'welcome prefix2';
    }
}
