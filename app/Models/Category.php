<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    protected $fillable = ['feature_id'];
}
