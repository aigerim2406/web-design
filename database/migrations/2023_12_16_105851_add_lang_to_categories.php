<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_kz')->nullable();
            $table->string('name_ru')->nullable();
            $table->string('name_en')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('name_kz');
            $table->dropColumn('name_ru');
            $table->dropColumn('name_en');
        });
    }
};
