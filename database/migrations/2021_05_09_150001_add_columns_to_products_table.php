<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->date('date_end')->after('date_available')->nullable();
            $table->integer('total_days')->after('image')->nullable();
            $table->integer('per_day_rate')->after('total_days')->nullable();
            $table->integer('sub_total')->after('per_day_rate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('date_end');
            $table->dropColumn('total_days');
            $table->dropColumn('per_day_rate');
            $table->dropColumn('sub_total');
        });
    }
}
