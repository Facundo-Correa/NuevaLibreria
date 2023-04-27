<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMercadoLibreCredentialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mercado_libre_credentials', function (Blueprint $table) {
            $table->id();
            $table->string('APP_ID')->nullable();
            $table->string('SELLER_ID')->nullable();
            $table->string('AUTH_TOKEN')->nullable();
            $table->string('ACCESS_TOKEN')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mercado_libre_credentials');
    }
}
