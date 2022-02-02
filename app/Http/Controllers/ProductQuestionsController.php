<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductQuestion as Question;
use Illuminate\Http\Request;

class ProductQuestionsController extends Controller
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Product $product)
    {
        $product->addQuestion($this->validateRequest());

        return redirect($product->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductQuestion as Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductQuestion as Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @param  \App\Models\ProductQuestion as Question  $question
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product, Question $question)
    {
        $question->update([
            'approved' => $request->has('approved')
        ]);

        return redirect($product->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductQuestion as Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }

    /**
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
            'question' => 'required|string',
            'author' => 'required|string',
        ]);
    }
}
