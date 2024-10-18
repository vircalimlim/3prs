<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuturismImage extends Model
{
    use HasFactory;

    public function futurism()
    {
        return $this->belongsTo(Futurism::class, 'post_id');
    }
}
