<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsAnchor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'institution',
        'proof_of_payment',
        'line',
        'ktm',
        'status'
    ];

    public function newsanchors(){
        return $this->hasOne(NewsAnchorPengumpulan::class, 'news_anchor_id', 'id');
    }
}
