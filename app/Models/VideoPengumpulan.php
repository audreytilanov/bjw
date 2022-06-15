<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoPengumpulan extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_id',
        'code',
        'file',
        'originalitas',
        'status',
    ];

    public function videos(){
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }
}
