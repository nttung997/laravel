<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('news_type_id');
            $table->string('title');
            $table->string('title_unsigned');
            $table->string('summary');
            $table->text('content');
            $table->string('image');
            $table->integer('hot');
            $table->integer('view');
            $table->timestamps();
            $table->foreign('news_type_id')->references('id')->on('news_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
