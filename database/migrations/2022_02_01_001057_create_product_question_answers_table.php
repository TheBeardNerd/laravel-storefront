<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_question_id');
            $table->text('body');
            $table->string('author');
            $table->integer('helpful')->default(0);
            $table->timestamps();

            $table->foreign('product_question_id')->references('id')->on('product_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_question_answers');
    }
}
