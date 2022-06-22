<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('member_id')->unsigned()->index();
            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('cascade');
            $table->date('order_date');
            $table->date('delivered_date')->nullable();
            $table->string('billing_first_name',191)->nullable();
            $table->string('billing_last_name',191)->nullable();
            $table->string('billing_company_name',191)->nullable();
            $table->bigInteger('country_id')->unsigned()->index();
            $table->string('billing_address_1',191)->nullable();
            $table->string('billing_address_2',191)->nullable();
            $table->string('billing_town_city',191)->nullable();
            $table->string('billing_state',191)->nullable();
            $table->string('billing_zip',191)->nullable();
            $table->string('billing_phone',191)->nullable();
            $table->string('billing_email',191)->nullable();
            $table->double('subtotal_amount', 10, 2);
            $table->double('total_amount', 10, 2);
            $table->string('payment_method');
            $table->enum('payment_status', ['pending','processing','completed','cancel']);
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
        Schema::dropIfExists('orders');
    }
}
