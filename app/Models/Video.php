<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_name',
        'email',
        'phone',
        'institution',
        'proof_of_payment',
        'line',
        'ktm',
        'status'
    ];

    public function groups(){
        return $this->hasMany(VideoTimDetail::class, 'video_id', 'id');
    }

    public function videos(){
        return $this->hasOne(VideoPengumpulan::class, 'video_id', 'id');
    }
}
