<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['persona_id'];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}