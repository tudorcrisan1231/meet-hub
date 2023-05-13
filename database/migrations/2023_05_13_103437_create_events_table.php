<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("description")->nullable();
            $table->string("location")->nullable();
            $table->string("date")->nullable();
            $table->string("time")->nullable();
            $table->string("image")->nullable();
            $table->string("users")->nullable();
            $table->integer("status")->nullable(); // 0 = urmeaza, 1 = are loc acum, 2 = a avut loc
            $table->string("type")->nullable();
            $table->integer("limit")->nullable();
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
        Schema::dropIfExists('events');
    }
};
