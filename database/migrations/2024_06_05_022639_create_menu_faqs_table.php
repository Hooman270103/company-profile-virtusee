<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_faqs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('menu_id')->unsigned()->nullable();
            $table->foreign('menu_id')
                ->references('id')->on('menus')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->bigInteger('faq_id')->unsigned()->nullable();
            $table->foreign('faq_id')
                ->references('id')->on('faqs')
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
        Schema::dropIfExists('menu_faqs');
    }
}
