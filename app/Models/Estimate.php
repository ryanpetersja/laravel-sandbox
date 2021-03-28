<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'date',
        
    ];

    public function line_items(){
        return $this->hasmany(LineItem::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function estimate_discounts(){
       return $this->hasMany(EstimateDiscount::class);
    }
}
