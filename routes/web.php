<?php

use App\Http\Controllers\Api\TodoController;

use App\Http\Livewire\BaseComments;
use App\Http\Livewire\Comments;
use App\Http\Livewire\LivewireTest;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\BaseRegister;
use App\Http\Livewire\WireStart;
use App\Http\Livewire\HelloWorld;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\TaskController;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


// Route::namespace
//use App\Http\Controllers\Dashboard\PurchaseController;
//use App\Http\Controllers\Dashboard\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', [LivewireTest::class, 'render'])
    ->name('test')
;

Route::get('wirestart', [WireStart::class, 'render'])->name('wire');

//Route::get('comment', function () {
//    $comments = Comment::all();
////    dd($comments);
//    return view('livewire.base-comments', compact('comments'));
//})->name('comment');
Route::get('comment', [BaseComments::class, 'render'])->name('comment');

/**
 * register 기본 route
 * laravel/bootstrap/cache/routes-v7.php
 * laravel/resources/views/auth/register.blade.php
 *
 * livewire V2 에서 제거됨
 * Route::livewire('register', 'register')->layout('layout.base');
 */
Route::get('register', [BaseRegister::class, 'render'])
    ->name('register')
;

/**
 * 서브 도메인 라우팅 1 : 호스트 미지정
 * 루트 도메인 라우트를 등록하기 전에 서브 도메인 라우트를 등록해야
 * 루트 도메인 라우트가 동일한 URI 라우트를 가진 서브 도메인 라우트를 덮어 쓰지 않음
 */
Route::domain('{account}.my.com')->group(function () {
    Route::get('/', function ($account) {
        if ($account === 'land') {
            return 'Hello, World!!!';
        }
        return view('welcome');
//        return $account;
    });
    Route::get('user/{id}', function ($account, $id) {
        return "Hi, {$id}. Welcome to the {$account}";
    });
});

/**
 * 서브 도메인 라우팅 2 : 호스트 지정
 * 상단 서브 도메인 라우트 설정으로인해 기본 URI ('/') 접근시 지정된 about 뷰로 이동하지 않음
 * 우선 순위 : 서브 도메인 라우팅 1 > 서브 도메인 라우팅 2 > 루트 도메인 라우팅
 */
Route::domain('api.my.com')->group(function () {
    Route::get('/', function () {
        // return 이 없는 경우 빈 페이지가 로드됨
        return view('about');
    });
    Route::get('products', function () {
        return view('services');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', function () {
    return view('about');
});

Route::get('products', function () {
    return view('products');
});

Route::get('services', function () {
    return view('services');
});

Route::get('hello', function () {
//    return 'Hello, World!';
    return env('DB_HOST');
});

Route::get('welcome', [WelcomeController::class, 'index']);

Route::get('post', [WelcomeController::class, 'post']);
Route::get('welcome/post', [WelcomeController::class, 'post']);

/**
 * 라우트에 이름 지정
 */
Route::get('welcome/users/{id}', [WelcomeController::class, 'users'])->name('welcome.user');

/**
 * 라우트의 공통 url 경로 처리
 * welcome 경로를 그룹으로 묶어 매번 타이핑하지 않음
 */
Route::prefix('welcome')->group(function () {
    Route::get('prefix1', [WelcomeController::class, 'prefix1']);
    Route::get('prefix2', [WelcomeController::class, 'prefix2']);
});

Route::prefix('user')->group(function () {
    Route::get('{id}', [UserController::class, 'show'])->name('user.show');

    // 하단 루트 도메인 라우트는 (user/index) 상단의 서브 도메인 라우팅 1 에 의해 덮어씌워짐
    Route::get('/', [UserController::class, 'index']);

    Route::get('chkId/{id}', function ($id) {
        return $id;
    });
});

/**
 * 공통 네임스페이스 접두사 지정
 * 문자열(컨트롤러@메소드) 문법일때 편의를 위해 namespace 메소드 사용
 * 튜플(tuple) 문법일때 namespace 메소드 사용은 의미 없음, route 에 namespace 가 누락되면 오류 발생
 * 파라미터 뒤에 물음표(?)를 붙이면 필수로 확인하지 않음, 해당 컨트롤러 메소드에서 기본 값이 지정되어 있어야함
 * uri 에 필수 파라미터가 누락된 경우 fallback 메소드 호출됨
 * 파라미터 타입 오류인 경우 fatal 오류 발생
 */
Route::namespace('App\Http\Controllers\Dashboard')->group(function () {
    Route::get('dashboard/purchase', 'PurchaseController@index');
    Route::get('dashboard/purchase/search/{order_num}/{user_name}/{goods_name?}',
        [\App\Http\Controllers\Dashboard\PurchaseController::class, 'search']
    );
    Route::get('dashboard/user', 'UserController@index');
    Route::get('dashboard/user/search/{user_name}/{user_phone}/{user_type?}',
        [\App\Http\Controllers\Dashboard\UserController::class, 'search']
    );
});

/**
 * 서명이 확인된 경우에만 라우트 접근 허용
 * .env 파일의 APP_URL 과 브라우저의 URL 이 다르면 서명 확인 안됨 (그럼 APP_URL 값은 유일하므로 루트 도메인만 서명 사용 가능?)
 * 서명 후 URI 의 파라미터 값이 변경되거나 추가되는 경우 403 오류 발생
 */
Route::get('invitation', [InvitationController::class, 'index']);
Route::get('invitations/{invitation}/{group}', [InvitationController::class, 'invitations'])->name('invitation_test')
->middleware('signed');

/**
 * 리소스 컨트롤러 바인딩
 * 리소스 컨트롤러 (--resource 명령을 통해 생성) 연결
 * 모든 라우트가 지정된 컨트롤러의 메소드에 자동으로 연결됨
 * 리소스 컨트롤러 : 라라벨 관례의 전통적인 REST/CRUD 메소드를 가지고 생성된 컨트롤러
 */
Route::resource('tasks', TaskController::class);

// except create, edit
Route::apiResource('todos', TodoController::class)
    ->missing(function (Request $request) {
        return Redirect::route('todos.index');
    });
//Route::get('todos', [TodoController::class, 'index'])->name('todos.index');
//Route::get('todos/{id}', [TodoController::class, 'show'])->name('todos.show');


/**
 * 모든 라우트 매칭 실패시 대체 라우트 설정
 */
Route::fallback(function () {
    return view('fail');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
