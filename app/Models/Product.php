<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'brand', 'description', 'price'];

    /**
     *  The path to the product.
     *
     * @return string
     */
    public function path()
    {
        return "/products/{$this->id}";
    }

    /**
     * The reviews associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    /**
     * The questions associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(ProductQuestion::class);
    }

    /**
     * Add a review to the product.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function addReview($attributes)
    {
        return $this->reviews()->create($attributes);
    }

    /**
     * Add a question to the product.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function addQuestion($attributes)
    {
        return $this->questions()->create($attributes);
    }

    /**
     * Record activity for a product.
     *
     * @param  string $type
     */
    public function recordActivity($type)
    {
        $this->activity()->create([
            'description' => $type
        ]);
    }

    /**
     * The activity feed for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class);
    }
}
