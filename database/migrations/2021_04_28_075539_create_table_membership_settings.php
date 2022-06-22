<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMembershipSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('membership_type_id')->unsigned()->index();
            $table->integer('photo')->default(0);
            $table->integer('video')->default(0);
            $table->integer('song')->default(0);
            $table->integer('instrument')->default(0);
            $table->boolean('full_access')->default(false);
            $table->boolean('home_access')->default(false);
            $table->boolean('about_us')->default(false);
            $table->boolean('view_event')->default(false);
            $table->boolean('post_event')->default(false);
            $table->boolean('request_to_book_band')->default(false);
            $table->boolean('post_classified')->default(false);
            $table->boolean('view_classified')->default(false);
            $table->boolean('cd_store')->default(false);
            $table->boolean('cd_sell')->default(false);
            $table->boolean('musian_search')->default(false);
            $table->boolean('radio_submit')->default(false);
            $table->boolean('radio_listen')->default(false);
            $table->boolean('contact_us')->default(false);
            $table->float('sign_up_fee')->default(0);
            $table->string('sign_up_fee_duration',191)->nullable();
            $table->integer('number_of_song_upload')->default(0);
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('membership_settings');
    }
}
