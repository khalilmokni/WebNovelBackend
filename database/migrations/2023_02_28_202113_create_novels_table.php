<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novels', function (Blueprint $table) {
            $table->id();
            $table->string('urlNovel');
            $table->string('nameNovel');
            $table->string('authorNovel');
            $table->string('translatorNovel');
            $table->integer('ratingNovel');
            $table->string('stateNovel');
            $table->date('releaseDateNovel');
            $table->integer('coinsNovel');
            $table->string('descriptionNovel');
            $table->string('tagsNovel');
            $table->integer('currentRankNovel');
            $table->integer('previousRankNovel');
            $table->integer('readerNovel');
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
        Schema::dropIfExists('novels');
    }
};
