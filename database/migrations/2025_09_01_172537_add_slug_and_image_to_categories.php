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
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
            $table->boolean('is_active')->default(true)->after('slug');
            $table->string('image')->nullable()->after('is_active');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
        $table->dropColumn(['slug', 'is_active', 'image']);
    });

    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('slug');
    });
    }
};
