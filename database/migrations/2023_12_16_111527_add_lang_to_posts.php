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
        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_kz')->nullable();
            $table->string('title_ru')->nullable();
            $table->string('title_en')->nullable();
            $table->string('content_kz')->nullable();
            $table->string('content_ru')->nullable();
            $table->string('content_en')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('title_kz');
            $table->dropColumn('title_ru');
            $table->dropColumn('title_en');
            $table->dropColumn('content_kz');
            $table->dropColumn('content_ru');
            $table->dropColumn('content_en');
        });
    }
};
