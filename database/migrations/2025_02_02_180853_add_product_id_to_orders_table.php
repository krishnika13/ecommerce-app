<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_product_id_to_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductIdToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add the product_id column with a foreign key constraint to the products table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Make sure you have a 'products' table
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the product_id column
            $table->dropColumn('product_id');
        });
    }
}
