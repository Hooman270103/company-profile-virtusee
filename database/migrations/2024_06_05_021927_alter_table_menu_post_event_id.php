<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableMenuPostEventId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menu_posts', function (Blueprint $table) {
            $table->bigInteger('event_id')->unsigned()->nullable()->after('post_id');
            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menu_posts', function (Blueprint $table) {
            $table->foreignId(['event_id']);
            $table->dropColumn(['event_id']);
        });
    }
}
