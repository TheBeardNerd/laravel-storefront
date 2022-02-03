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
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'approved' => 'boolean',
    ];

    /**
     * Get the product that the review belongs to.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     *  The path to the review.
     *
     * @return string
     */
    public function path()
    {
        return "/products/{$this->product->id}/reviews/{$this->id}";
    }

    /**
     * Mark the review as approved.
     */
    public function approve() {
        $this->update(['approved' => true]);
    }

    /**
     * Mark the review as disapproved.
     */
    public function disapprove() {
        $this->update(['approved' => false]);
    }
}
