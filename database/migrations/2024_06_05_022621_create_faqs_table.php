<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->longText('questions');
            $table->longText('answers');

            $table->enum('published', [1, 2])->nullable()->comment('1 = Unpublished, 2 = Published');
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
        Schema::dropIfExists('faqs');
    }
}
