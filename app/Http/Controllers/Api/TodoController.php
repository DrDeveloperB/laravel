<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class TodoController extends Controller
{
    /**
     * 목록
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**
         * 디비 조회
         */
//        $todos = Todo::all();     // *
        // 조회할 컬럼 지정
        $todos = Todo::select('id', 'title', 'content', 'created_at')->orderByDesc('id')->get();

        // use Facades\DB
//        $todos = DB::table('todos')->select('id', 'title', 'content', 'created_at')->orderByDesc('id')->get();

        /**
         * 리소스 사용
         * /laravel/app/Http/Resources/TodoResource.php
         * 데이터 반환시 리소스 사용전에는 key 값이 없지만 사용후에는 data 라는 key 값이 적용됨
         */

        /**
         * 리소스 부모 객체 선택에 따른 사용법 : class TodoResource extends JsonResource
         */
        $todos = TodoResource::collection($todos);
        return $todos;

        /**
         * 리소스 부모 객체 선택에 따른 사용법 : class TodoResource extends ResourceCollection
         */
//        return new TodoResource($todos);
    }

    /**
     * 입력 폼
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * 데이터 생성
     * PostMan 테스트시 유의 사항
     * 1. POST 메소드 사용
     * 2. Body -> form-data 에 파라미터 입력
     * 3. 선택사항 : Headers -> Accept = application/json
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = Todo::create($request->all());
//        $todo = TodoResource::collection($todo);      // ERROR : Call to undefined method App\Models\Todo::mapInto()
//        $todo->type = gettype($todo);
//        $todo = (array) $todo;
//        $todo['type'] = gettype($todo);
//        $todo = new TodoResource($todo);          // ERROR : Undefined property: Illuminate\Database\MySqlConnection::$id
        return $todo;
    }

    /**
     * 조회
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // select * from todos where id = 3
//        $todo = Todo::find($id);
        $todo = Todo::where('id', $id)->get();
        $todo = TodoResource::collection($todo);
        return $todo;
    }

    /**
     * 수정 폼
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 데이터 수정
     * PostMan 테스트시 유의 사항
     * 1. PUT 메소드 사용
     * 2. Body -> x-www-form-urlencoded 에 파라미터 입력
     * 3. 선택사항 : Headers -> Accept = application/json
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::where('id', $id)->update($request->all());        // result : 0, 1
        $todo = $todo ? 'true' : 'false';
//        $todo = TodoResource::collection($todo);        // Call to a member function first() on int
        return $todo;
    }

    /**
     * 데이터 삭제
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::where('id', $id)->delete();        // result : 0, 1
        $todo = $todo ? 'true' : 'false';
        return response(null, Response::HTTP_NO_CONTENT)->header('result', $todo);
        // api-result = view 파일
//        return response()->view('api-result', ['resulttodo' => $todo], 200)->header('Content-Type', 'text/plain');
    }
}
