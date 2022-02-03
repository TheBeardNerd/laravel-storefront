<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\ProductReview;

class ProductReviewObserver
{
    /**
     * Handle the ProductReview "created" event.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return void
     */
    public function created(ProductReview $productReview)
    {
        $productReview->product->recordActivity('review_created');
    }

    /**
     * Handle the ProductReview "updated" event.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return void
     */
    public function updated(ProductReview $productReview)
    {
        $productReview->product->recordActivity('review_approved');
    }

    /**
     * Handle the ProductReview "deleted" event.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return void
     */
    public function deleted(ProductReview $productReview)
    {
        //
    }

    /**
     * Handle the ProductReview "restored" event.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return void
     */
    public function restored(ProductReview $productReview)
    {
        //
    }

    /**
     * Handle the ProductReview "force deleted" event.
     *
     * @param  \App\Models\ProductReview  $productReview
     * @return void
     */
    public function forceDeleted(ProductReview $productReview)
    {
        //
    }
}
