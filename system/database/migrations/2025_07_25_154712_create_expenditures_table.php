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
        Schema::create('expenditures', function (Blueprint $table) {
            $table->id();
            $table->string('purpose');
            $table->date('date');
            $table->integer('amount');
            $table->foreignId('wishlist_id')->nullable()->constrained('wishlists')->nullOnDelete();
            $table->foreignId('monthly_finance_id')->nullable()->constrained('monthly_finances')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenditures');
    }
};
