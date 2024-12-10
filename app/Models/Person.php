<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function supplier()
    {
        return $this->hasOne(Supplier::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    protected $fillable = ['social_reason', 'address', 'person_type', 'status', 'document_id'];
}
