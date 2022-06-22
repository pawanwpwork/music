<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsSocialsInMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('facebook_url',191)->nullable();
            $table->string('instagram_url',191)->nullable();
            $table->string('twitter_url',191)->nullable();
            $table->string('youtube_url',191)->nullable();
            $table->text('short_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('facebook_url');
            $table->dropColumn('instagram_url');
            $table->dropColumn('twitter_url');
            $table->dropColumn('youtube_url');
            $table->dropColumn('short_description');
        });
    }
}
