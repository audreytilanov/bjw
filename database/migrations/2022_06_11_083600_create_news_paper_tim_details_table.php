<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsPaperTimDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_paper_tim_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_paper_id');
            $table->string('name');

            $table->foreign('news_paper_id')->references('id')->on('news_papers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_paper_tim_details');
    }
}
