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
        Schema::create('manners', function (Blueprint $table) {
            $table->id();
            $table->string("date");
            $table->string("timestart");
            $table->string("timeend");
            $table->string("trainer");
            $table->integer("availslot")->default(3);
            $table->enum("status", ["full", "available"]);
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
        Schema::dropIfExists('manners');
    }
};
