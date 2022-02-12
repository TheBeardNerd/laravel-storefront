<?php

namespace App\Models\Product;

use App\Models\Activity;
use App\Models\User;
use App\Traits\RecordsActivity;
use Database\Factories\Product\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, RecordsActivity;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['creator_id', 'name', 'brand', 'description', 'price'];

    /**
     * Model events that should trigger new activity.
     *
     * @var array
     */
    protected static $recordableEvents = ['created', 'updated'];

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
     * The creator of the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The activity feed for the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    /**
     * The reviews associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
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
     * The questions associated with the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
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
}
