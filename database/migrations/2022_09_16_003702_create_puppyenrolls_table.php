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
        Schema::create('puppyenrolls', function (Blueprint $table) {
            $table->unsignedBigInteger('puppy_id')->nullable();
            $table->foreign('puppy_id')->references('id')->on('puppies')->onDelete('cascade'); 
            $table->id();
            $table->string("petname");
            $table->integer("age");
            $table->string("ownername");
            $table->string("email");
            $table->string("phonenumber");
            $table->string("address");
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
        Schema::dropIfExists('puppyenrolls');
    }
};
