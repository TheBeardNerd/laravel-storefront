<?php

namespace App\Models\Product;

use Database\Factories\Product\ProductAnswerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_answers';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ProductAnswerFactory::new();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_question_id', 'body', 'author', 'helpful'];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['question'];

    /**
     * Get the question that the answer belongs to.
     */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
