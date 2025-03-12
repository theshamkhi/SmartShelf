<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Rayon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'rayon_id',
        'category',
        'is_promoted',
        'popularity',
    ];

    public function rayon(): BelongsTo
    {
        return $this->belongsTo(Rayon::class);
    }
}
