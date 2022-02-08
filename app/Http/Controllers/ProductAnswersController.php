<?php

namespace App\Http\Controllers;

use App\Models\Product\Product;
use App\Models\Product\Question;
use App\Models\Product\Answer;
use Illuminate\Http\Request;

class ProductAnswersController extends Controller
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
     * @param  \App\Models\Product  $product
     * @param  \App\Models\Product\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product, Question $question)
    {
        $question->addAnswer($this->validateRequest());

        return redirect($product->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductAnswer $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductAnswer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductAnswer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Answer $answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductAnswer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }

    /**
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
            'body' => 'required|string',
            'author' => 'required|string',
        ]);
    }
}
