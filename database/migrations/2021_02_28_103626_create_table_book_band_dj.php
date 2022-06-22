<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBookBandDj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_band_dj', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Band', 'DJ']);
            // $table->bigInteger('member_id')->unsigned()->nullable();
            $table->string('add_user_type', 100)->comment('member,admin');
            $table->string('name',100)->nullable();
            $table->string('contact_number',100)->nullable();
            $table->date('event_date')->nullable();
            $table->string('address',100)->nullable();
            $table->float('budget')->nullable();
            $table->string('type_of_music',100)->nullable();
            $table->integer('order_status')->default(0);
            $table->bigInteger('booked_by')->unsigned()->nullable();
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_band_dj');
    }
}
