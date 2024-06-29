<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')
            ->references('id')->on('menus')
            ->onDelete('cascade')
            ->onUpdate('restrict');

            $table->string('slug');
            $table->string('name');
            $table->string('link_url')->nullable();
            $table->integer('position')->unique();

            $table->enum('type', [1,2])->default(1)->comment('1=menu parent/child, 2=url');
            $table->enum('status', [1, 2])->default(2)->comment('1 = Tidak Aktif, 2 = Aktif');

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
        Schema::dropIfExists('menus');
    }
}
