<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsPaper extends Model
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
        return $this->hasMany(NewsPaperTimDetail::class, 'news_paper_id', 'id');
    }
}
