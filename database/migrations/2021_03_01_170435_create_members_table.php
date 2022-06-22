<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id(); 
            $table->string('first_name',191);
            $table->string('last_name',191);
            $table->string('email',191);
            $table->string('password',191);
            $table->string('address',191)->nullable();
            $table->string('city',191)->nullable();
            $table->string('state',191)->nullable();
            $table->string('country',191)->nullable();
            $table->string('zipcode',191)->nullable();
            $table->string('phone',191)->nullable();
            $table->date('dob')->nullable();
            $table->bigInteger('music_genre_id')->unsigned()->index();
            $table->bigInteger('membership_type_id')->unsigned()->index();
            $table->string('ip')->nullable();
            $table->date('date_added')->nullable();
            $table->boolean('status')->defautl(1);
            $table->enum('approved', ['Yes', 'No'])->default('No');
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
        Schema::dropIfExists('members');
    }
}
