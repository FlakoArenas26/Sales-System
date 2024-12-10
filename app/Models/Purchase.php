<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_time',
        'tax',
        'voucher_number',
        'total',
        'voucher_id',
        'supplier_id',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps()
            ->withPivot('quantity', 'purchase_price', 'selling_price');
    }
}
