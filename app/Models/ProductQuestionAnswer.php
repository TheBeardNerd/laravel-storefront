<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductQuestionAnswer extends Model
{
    use HasFactory;

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
        return $this->belongsTo(ProductQuestion::class);
    }
}
