<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_posts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('menu_id')->unsigned()->nullable();
            $table->foreign('menu_id')
                ->references('id')->on('menus')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->bigInteger('post_id')->unsigned()->nullable();
            $table->foreign('post_id')
                ->references('id')->on('posts')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->bigInteger('deleted_by')->unsigned()->nullable();
            $table->foreign('deleted_by')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('restrict');
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
        Schema::dropIfExists('menu_posts');
    }
}
