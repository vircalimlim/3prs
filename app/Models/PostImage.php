<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    public function achievement()
    {
        return $this->belongsTo(Achievement::class, 'post_id')->where('category', 'achievements');
    }

    public function announcement()
    {
        return $this->belongsTo(Achievement::class, 'post_id')->where('category', 'announcements');
    }
}
