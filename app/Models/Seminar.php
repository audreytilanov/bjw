<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seminar extends Model
{
    use HasFactory;

    protected $table = 'seminars';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'institution',
        'proof_of_payment',
        'line',
        'status'
    ];
}
