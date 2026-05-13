<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'image'];

    // Relationships
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getImage()
    {
        return Storage::url($this->image);
    }
}
