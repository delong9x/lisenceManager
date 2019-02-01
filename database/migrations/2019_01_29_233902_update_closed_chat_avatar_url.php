<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateClosedChatAvatarUrl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (Schema::hasTable('websites')) {
            Schema::table('websites', function (Blueprint $table) {
                $table->string('closed_chat_avatar_url')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('websites', function (Blueprint $table) {
            $table->drop([
                'closed_chat_avatar_url'
            ]);
            $table->dropTimestamps();
        } );
    }
}
