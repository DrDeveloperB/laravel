<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\URL;

class UserController extends BaseController
{
    function index()
    {
        $data['as'] = 'aaa1';
        $data['normal'] = URL::route('invitation_test', ['invitation' => 1234, 'group' => 56]);
        $data['signed'] = URL::signedRoute('invitation_test', ['invitation' => 67, 'group' => 890]);
        $data['signed_expire'] = URL::temporarySignedRoute('invitation_test', now()->addMinute(1), ['invitation' => 987, 'group' => 7654]);

        echo "<xmp>";
        print_r($data);
        echo "</xmp>";
        return view('user');
    }
}
