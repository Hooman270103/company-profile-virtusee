<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuTestimonisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_testimonis', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('menu_id')->unsigned()->nullable();
            $table->foreign('menu_id')
                ->references('id')->on('menus')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->bigInteger('testimoni_id')->unsigned()->nullable();
            $table->foreign('testimoni_id')
                ->references('id')->on('testimonis')
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
        Schema::dropIfExists('menu_testimonis');
    }
}
