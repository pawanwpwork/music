<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePivotBandDjAgeGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_band_dj_event_age_group', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('book_band_dj_id')->unsigned()->index();
            $table->foreign('book_band_dj_id')->references('id')->on('book_band_dj');

            $table->bigInteger('age_group_id')->unsigned()->index();
            $table->foreign('age_group_id')->references('id')->on('band_dj_age_groups');
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
        Schema::dropIfExists('pivot_band_dj_event_age_group');
    }
}
