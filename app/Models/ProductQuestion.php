<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuestion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'question', 'author', 'approved'];

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
     * Get the product that the question belongs to.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The answers associated with the question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(ProductQuestionAnswer::class);
    }

    /**
     *  The path to the question.
     *
     * @return string
     */
    public function path()
    {
        return "/products/{$this->product->id}/questions/{$this->id}";
    }

    /**
     * Mark the question as approved.
     */
    public function approve() {
        $this->update(['approved' => true]);
    }

    /**
     * Mark the question as disapproved.
     */
    public function disapprove() {
        $this->update(['approved' => false]);
    }

    /**
     * Add an answer to the question.
     *
     * @param array $attributes
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function addAnswer($attributes)
    {
        return $this->answers()->create($attributes);
    }
}
