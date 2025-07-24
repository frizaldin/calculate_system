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
        Schema::table('monthly_finances', function (Blueprint $table) {
            $table->dropColumn('billed_date');
            $table->integer('billed_day')->after('installments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_finances', function (Blueprint $table) {
            $table->dropColumn('billed_day');
            $table->date('billed_date')->after('installments');
        });
    }
};
