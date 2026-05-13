<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'image_url', 'is_primary'];

    // Relationships
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImage()
    {
        return Storage::url($this->image_url);
    }
}
