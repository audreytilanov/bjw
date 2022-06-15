<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsAnchorPengumpulansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_anchor_pengumpulans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('news_anchor_id');
            $table->string('code');
            $table->string('file')->nullable();
            $table->string('originalitas')->nullable();
            $table->string('status')->default('0');

            $table->timestamps();

            $table->foreign('news_anchor_id')->references('id')->on('news_anchors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news_anchor_pengumpulans');
    }
}
