<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $fillable = ['author_id', 'title', 'is_borrowed'];

    public function authors()
    {
        return $this->belongsTo(Authors::class,'author_id');
    }
}
