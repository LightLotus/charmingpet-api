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
        Schema::create('puppy_puppyenrolls', function (Blueprint $table) {
            $table->foreignId('puppy_id')->nullable()->constrained('puppies');
            $table->foreignId('puppyenroll_id')->nullable()->constrained('puppyenrolls');
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
        Schema::dropIfExists('puppy_puppyenrolls');
    }
};
