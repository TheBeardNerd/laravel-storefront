<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand', 'description', 'price'];

    public function path()
    {
        return "/products/{$this->id}";
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    public function addReview($attributes)
    {
        return $this->reviews()->create($attributes);
    }
}
