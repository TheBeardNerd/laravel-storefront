<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'rating', 'author', 'title', 'body', 'recommended', 'helpful', 'approved'];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['product'];

    /**
     * Get the product that the product review belongs to.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     *  The path to the product review.
     *
     * @return string
     */
    public function path()
    {
        return "/products/{$this->product->id}/reviews/{$this->id}";
    }
}
