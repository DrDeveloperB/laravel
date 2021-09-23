<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function writer()
    {
        return $this->belongsTo(User::class, 'id');
    }
//    public function user()
//    {
//        return $this->belongsTo(User::class);
//    }

//    protected $fillable = ['id', 'creator', 'created_at', 'body'];

//    protected $dates = ['created_at'];
}
