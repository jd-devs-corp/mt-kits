<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnpayKit extends Model
{
    use HasFactory;

    protected $filable = [
        'kit_number',
        'statut',
        'user_id',
    ];

    public function kit(){
        return $this->hasOne(Kit::class);
    }
}
