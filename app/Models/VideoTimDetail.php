<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoTimDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'name',
    ];

    public function videos(){
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }
}
