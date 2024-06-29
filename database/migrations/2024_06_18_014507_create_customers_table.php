<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', [1, 2])->default(1)->comment('1 = Male, 2 = Female');
            $table->string('email');
            $table->string('phone');
            $table->longText('address')->nullable();
            $table->string('title');
            $table->string('know_where');

            $table->string('company_name');

            $table->char('province_id', 2)->nullable();
            $table->foreign('province_id')
                ->references('id')
                ->on('provinces')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->char('regency_id', 4)->nullable();
            $table->foreign('regency_id')
                ->references('id')
                ->on('regencies')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->char('district_id', 7)->nullable();
            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->char('village_id')->nullable();
            $table->foreign('village_id')
                ->references('id')
                ->on('villages')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->string('company_address');
            $table->longText('company_phone');
            $table->string('company_email');

            $table->longText('description');

            $table->dateTime('schedule')->nullable();
            $table->enum('marketing_contact', [1,2])->default(1)->comment('1:bersedia, 2:tidak bersedia');

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
        Schema::dropIfExists('customers');
    }
}
