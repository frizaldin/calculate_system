<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('monthly_finances', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('installments')->nullable();
            $table->date('billed_date');
            $table->enum('type', ['Temporary', 'Permanent']);
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['Done', 'On Going']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_finances');
    }
};
