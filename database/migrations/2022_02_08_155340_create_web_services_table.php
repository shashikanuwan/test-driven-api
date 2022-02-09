<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebServicesTable extends Migration
{
    public function up()
    {
        Schema::create('web_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('token');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('web_services');
    }
}
