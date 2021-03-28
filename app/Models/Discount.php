<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rate',
        'description'
    ];

    public function estimate_discount(){
        $this->hasMany(EstimateDiscount::class);
    }
}
