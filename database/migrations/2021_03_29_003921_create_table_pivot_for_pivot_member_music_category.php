<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePivotForPivotMemberMusicCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pivot_member_music_category', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('music_category_id')->unsigned()->index();
            
            $table->bigInteger('member_id')->unsigned()->index();
            
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
        Schema::dropIfExists('pivot_member_music_category');
    }
}
