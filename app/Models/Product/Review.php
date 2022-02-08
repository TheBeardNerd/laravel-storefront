<?php

namespace App\Models\Product;

use App\Traits\RecordsActivity;
use Database\Factories\Product\ProductReviewFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory, RecordsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_reviews';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ProductReviewFactory::new();
    }

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
