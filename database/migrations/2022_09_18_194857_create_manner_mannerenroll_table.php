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
        Schema::create('manner_mannerenroll', function (Blueprint $table) {
            $table->foreignId('manner_id')->nullable()->constrained('manners');
            $table->foreignId('mannerenroll_id')->nullable()->constrained('mannerenrolls');
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
        Schema::dropIfExists('manner_mannerenroll');
    }
};
