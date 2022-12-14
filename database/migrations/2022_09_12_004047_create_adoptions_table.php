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
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id();
            $table->string("petname");
            $table->enum("status", ["available", "pending", "taken"]);
            $table->longText("description");
            $table->string("animaltype");
            $table->string("estbirthday");
            $table->string("color");
            $table->enum("sex", ["male", "female"]);
            $table->longText("imgsrc");
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
        Schema::dropIfExists('adoptions');
    }
};
