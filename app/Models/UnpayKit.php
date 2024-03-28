<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnpayKit extends Model
{
    use HasFactory;

    protected $filable = [
        'kit_number',
        'user_id',
        'statut'
    ];

    public function is_paid(){
        return $this->hasOne(Kit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
