<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInSiteSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('address_1',191)->nullable();
            $table->string('address_2',191)->nullable();
            $table->string('mobile',191)->nullable();
            $table->string('email',191)->nullable();
            $table->text('iframe')->nullable();
            $table->string('home_slider_title',191)->nullable();
            $table->string('home_slider_subtitle',191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('site_settings', function (Blueprint $table) {
            //
        });
    }
}
