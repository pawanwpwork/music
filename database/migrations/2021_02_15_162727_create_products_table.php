<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id')->unsigned()->nullable();
            $table->string('add_user_type', 100)->comment('member,admin');
            $table->string('name', 100);
            $table->text('description');
            $table->string('meta_tag_title', 150)->nullable();
            $table->text('meta_tag_description')->nullable();
            $table->text('meta_tag_keyword', 150)->nullable();
            $table->text('product_tag')->nullable();
            $table->string('model',191)->nullable();
            $table->string('sku',191)->nullable();
            $table->string('locations',191)->nullable();
            $table->double('price', 10, 2);
            $table->integer('quantity');
            $table->enum('subtract_stock', ['Yes', 'No'])->default('Yes');
            $table->enum('out_of_stock', ['2-3_days', 'in_stock', 'out_of_stock', 'pre_order'])->default('in_stock');
            $table->date('date_available')->nullable();
            $table->integer('length')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->enum('length_class', ['centimeter', 'milimeter', 'inch'])->nullable();
            $table->integer('weight')->nullable();
            $table->enum('weight_unit', ['kilogram', 'gram', 'pound', 'ounce'])->nullable();
            $table->boolean('status')->default(0);
            $table->integer('sort_order')->nullable();
            $table->string('manufacturer',191)->nullable();
            $table->string('categories',191)->nullable();
            $table->string('downloads',191)->nullable();
            $table->string('related_products',191)->nullable();
            $table->string('image',191)->nullable();
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
        Schema::dropIfExists('products');
    }
}
