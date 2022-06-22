<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id')->unsigned()->nullable();
            $table->string('add_user_type', 100)->comment('member,admin');
            $table->string('name', 100);
            $table->string('alias', 100);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->time('time')->nullable();
            $table->float('pay_per_day', 10, 2)->nullable();
            $table->float('total_days', 10, 2)->nullable();
            $table->float('sub_total', 10, 2)->nullable();
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->enum('status', ['pending', 'approved', 'cancel'])->default('pending');
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
        Schema::dropIfExists('events');
    }
}
