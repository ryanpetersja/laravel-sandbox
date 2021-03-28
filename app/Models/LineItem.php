<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineItem extends Model
{
    use HasFactory;

    public function estimate(){
        return $this->belongsTo(Estimate::class);
    }

    protected $fillable = [
        'estimate_id',
        'title',
        'description',
        'amount',
    ];
}
