<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsInMemberSongs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('member_songs', function (Blueprint $table) {
            $table->string('alias',191)->after('title');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('member_songs', function (Blueprint $table) {
            $table->dropColumn('alias');
            $table->dropColumn('updated_by');
            $table->dropColumn('created_by');
        });
    }
}
