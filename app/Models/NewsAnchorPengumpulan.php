<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsAnchorPengumpulan extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_anchor_id',
        'code',
        'file',
        'originalitas',
        'status',
    ];

    public function newsanchor(){
        return $this->belongsTo(NewsAnchor::class, 'news_anchor_id', 'id');
    }
}
