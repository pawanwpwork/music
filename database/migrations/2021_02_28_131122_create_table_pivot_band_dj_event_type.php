<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePivotBandDjEventType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_band_dj_event_type', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('book_band_dj_id')->unsigned()->index();
            $table->foreign('book_band_dj_id')->references('id')->on('book_band_dj');

            $table->bigInteger('event_type_id')->unsigned()->index();
            $table->foreign('event_type_id')->references('id')->on('band_dj_event_types');
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
        Schema::dropIfExists('pivot_band_dj_event_type');
    }
}
