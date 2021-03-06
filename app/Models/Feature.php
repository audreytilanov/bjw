<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
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

    public function features(){
        return $this->hasOne(FeaturePengumpulan::class, 'feature_id', 'id');
    }
}
