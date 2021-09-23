<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * 조회한 컬럼 접근 설정
     * $fillable : 화이트 리스트
     * $guarded : 블랙 리스트 (지정된 컬럼을 제외하고 나머지 컬럼 접근 허용)
     * @var string[]
     */
    protected $fillable = ['id', 'title', 'content'];
//    protected $guarded = [];
}
