<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimateDiscount extends Model
{
    use HasFactory;

    public function estimate(){
        return $this->belongsTo(Estimate::class);
    }

    public function discount(){
        return $this->belongsTo(Discount::class);
    }

    protected $fillable = [
        'estimate_id',
        'discount_id',
        
    ];
}
