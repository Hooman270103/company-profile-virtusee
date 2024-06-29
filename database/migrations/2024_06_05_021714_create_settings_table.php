<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_primary')->nullable();
            $table->string('logo_secondary')->nullable();
            $table->string('favicon')->nullable();
            $table->string('name')->nullable();
            $table->string('tagline')->nullable();
            $table->longText('description')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('address')->nullable();
            $table->longText('maps_location')->nullable();

            $table->string('email')->nullable();
            $table->string('link_instagram')->nullable();
            $table->string('link_facebook')->nullable();
            $table->string('link_twitter')->nullable();
            $table->string('link_tiktok')->nullable();
            $table->string('link_linkedin')->nullable();
            
            $table->json('color_primary')->nullable();
            $table->json('color_secondary')->nullable();

            $table->string('mail_mailer')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_from_addres')->nullable();
            $table->string('mail_from_name')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
