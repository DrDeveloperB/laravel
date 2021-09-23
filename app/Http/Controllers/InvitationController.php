<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 컨트롤러 이름 뒤에 Controller 문자를 붙이지 않으면 메소드 생성시 자동완성 도움을 받을 수 없음
 */
class InvitationController extends Controller
{
    public function index() {
        return 'invitations';
    }

    public function invitations($invitation, $group) {
        echo "<xmp>";
        print_r($invitation);
        echo "</xmp>";
        return $group;
    }

    public function __invoke($invitation, $group, Request $request) {
        if (!$request->hasValidSignature()) {
            abort(403);
        }
    }
}
