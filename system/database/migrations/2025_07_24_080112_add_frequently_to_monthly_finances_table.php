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
            $table->enum('frequently', ['Yearly', 'Monthly'])->after('billed_day');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_finances', function (Blueprint $table) {
            $table->dropColumn('frequently');
        });
    }
};
