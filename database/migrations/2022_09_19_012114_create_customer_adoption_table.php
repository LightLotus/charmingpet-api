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
        Schema::create('customer_adoption', function (Blueprint $table) {
            $table->foreignId('adoption_id')->nullable()->constrained('adoptions');
            $table->foreignId('customer_id')->nullable()->constrained('customers');
            $table->enum('status', ['onreview', 'pending', 'canceled', 'closed', 'open', 'accepted'])->default('open');
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
        Schema::dropIfExists('customer_adoption');
    }
};