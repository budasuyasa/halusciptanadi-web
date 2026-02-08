<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('supplier_id')->nullable()->after('category_id')->constrained()->nullOnDelete();
        });

        Schema::dropIfExists('product_supplier');
    }

    public function down(): void
    {
        Schema::create('product_supplier', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('supplier_id')->constrained()->cascadeOnDelete();
            $table->decimal('cost_price', 12, 2)->nullable();
            $table->timestamps();

            $table->unique(['product_id', 'supplier_id']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropConstrainedForeignId('supplier_id');
        });
    }
};
