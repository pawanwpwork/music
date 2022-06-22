<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->text('description');
            $table->string('meta_tag_title',150)->nullable();
            $table->text('meta_tag_description')->nullable();
            $table->text('meta_tag_keyword',150)->nullable();
            $table->bigInteger('parent')->nullable();
            $table->string('image',191)->nullable();
            $table->bigInteger('sort_order');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('categories');
    }
}
