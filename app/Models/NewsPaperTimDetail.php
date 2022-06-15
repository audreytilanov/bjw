<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPaperTimDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'news_paper_id',
        'name',
    ];

    public function news(){
        return $this->belongsTo(NewsPaper::class, 'news_paper_id', 'id');
    }
}
