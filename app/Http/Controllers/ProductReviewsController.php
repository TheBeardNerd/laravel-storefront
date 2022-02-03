<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview as Review;
use Illuminate\Http\Request;

class ProductReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product)
    {
        $product->addReview($this->validateRequest());

        return redirect($product->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductReview as Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductReview as Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @param  \App\Models\ProductReview as Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Review $review)
    {
        $request->approved ? $review->approve() : $review->disapprove();

        return redirect($product->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductReview as Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }

    /**
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
            'rating' => 'required|between:1,5',
            'author' => 'required|string',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);
    }
}
