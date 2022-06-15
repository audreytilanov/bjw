<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturePengumpulan extends Model
{
    use HasFactory;

    protected $fillable = [
        'feature_id',
        'code',
        'file',
        'originalitas',
        'status',
    ];

    public function features(){
        return $this->belongsTo(Feature::class, 'feature_id', 'id');
    }
}
