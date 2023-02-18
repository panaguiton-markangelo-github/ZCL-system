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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('author');
            $table->string('place_pub');
            $table->string('edition_vol');
            $table->string('pagination');
            $table->date('date_acq');
            $table->string('published');
            $table->string('subject');
            $table->string('publisher')->nullable();
            $table->string('isbn');
            $table->string('source');
            $table->string('series');
            $table->string('incls');
            $table->string('property_no');
            $table->string('acc_no');
            $table->string('amount');
            $table->string('call_no');
            $table->string('lc');
            $table->string('ddc');
            $table->string('author_no');
            $table->string('c');
            $table->string('section');
            $table->text('summary');
            $table->string('collection');
            $table->string('shelf_location');
            $table->integer('price');
            $table->string('status');
            $table->dateTime('borrowed_at')->nullable();
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
        Schema::dropIfExists('books');
    }
};
