<?php

namespace App\Observers;

use App\Models\ProductQuestion;

class ProductQuestionObserver
{
    /**
     * Handle the ProductQuestion "created" event.
     *
     * @param  \App\Models\ProductQuestion  $productQuestion
     * @return void
     */
    public function created(ProductQuestion $productQuestion)
    {
        $productQuestion->product->recordActivity('question_created');
    }

    /**
     * Handle the ProductQuestion "updated" event.
     *
     * @param  \App\Models\ProductQuestion  $productQuestion
     * @return void
     */
    public function updated(ProductQuestion $productQuestion)
    {
        $productQuestion->product->recordActivity('question_approved');
    }

    /**
     * Handle the ProductQuestion "deleted" event.
     *
     * @param  \App\Models\ProductQuestion  $productQuestion
     * @return void
     */
    public function deleted(ProductQuestion $productQuestion)
    {
        //
    }

    /**
     * Handle the ProductQuestion "restored" event.
     *
     * @param  \App\Models\ProductQuestion  $productQuestion
     * @return void
     */
    public function restored(ProductQuestion $productQuestion)
    {
        //
    }

    /**
     * Handle the ProductQuestion "force deleted" event.
     *
     * @param  \App\Models\ProductQuestion  $productQuestion
     * @return void
     */
    public function forceDeleted(ProductQuestion $productQuestion)
    {
        //
    }
}
