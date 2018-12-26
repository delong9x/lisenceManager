<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChatInformationGenerate extends Migration
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
                $table->timestamps();
                $table->string('title_closed')->nullable();
                $table->string('title_open')->nullable();
                $table->string('intro_message')->nullable();
                $table->string('auto_response')->nullable();
                $table->string('auto_no_response')->nullable();
                $table->string('placeholder_text')->nullable();
                $table->string('get_customer_info_text')->nullable();
                $table->string('main_color')->nullable();
            });
        }
        if (Schema::hasTable('customers')) {
            Schema::table('customers', function (Blueprint $table) {
                $table->timestamps();
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
                'title_closed', 'title_open',
                'intro_message', 'auto_response',
                'placeholder_text', 'auto_no_response',
                'get_customer_info_text', 'main_color'
            ]);
            $table->dropTimestamps();
        } );
        Schema::table('customers', function (Blueprint $table) {
            $table->dropTimestamps();
        });

    }
}
