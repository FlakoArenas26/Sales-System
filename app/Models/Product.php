<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'description',
        'expiration_date',
        'brand_id',
        'presentation_id',
        'img_path',
    ];

    public function purchase()
    {
        return $this->belongsToMany(Purchase::class)->withTimestamps()
            ->withPivot('quantity', 'purchase_price', 'selling_price');
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class)->withTimestamps()
            ->withPivot('quantity', 'selling_price', 'discount');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function presentation()
    {
        return $this->belongsTo(Presentation::class);
    }

    public function handleUploadImage($image)
    {
        $file = $image;
        $name = time() . $file->getClientOriginalName();
        //$file->move(public_path() . '/img/productos/', $name);
        Storage::putFileAs('/public/products/', $file, $name, 'public');

        return $name;
    }
}
