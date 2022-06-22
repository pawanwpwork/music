<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMemberSongs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_songs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id')->unsigned()->nullable();
            $table->string('title',191)->nullable();
            $table->string('label',191)->nullable();
            $table->string('artist',191)->nullable();
            $table->time('duration')->nullable();
            $table->string('song',191);
            $table->string('lyrics',191)->nullable();
            $table->boolean('status')->default(false);
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
        Schema::dropIfExists('member_songs');
    }
}
