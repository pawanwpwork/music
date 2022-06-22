<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id')->unsigned()->index();
            $table->string('type',191)->nullable()->comment('membership, event, book_band_dj, classified_buy, classified_sell, cd_buy & cd_sell');
            $table->string('product_name')->nullable();
            $table->float('price')->nullable();
            $table->integer('quantity')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
