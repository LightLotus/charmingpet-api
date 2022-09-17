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
        Schema::create('mannerenrolls', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('manner_id')->constrained('manners')->onDelete('cascade');
            $table->unsignedBigInteger('manner_id');
            $table->foreign('manner_id')->references('id')->on('manners')->onDelete('cascade');
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
        Schema::dropIfExists('mannerenrolls');
    }
};
