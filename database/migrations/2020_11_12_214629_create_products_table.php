<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductsTable
 */
class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('vendor_code');
            $table->string('type');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->string('barcode');
            $table->string('stock');
            $table->decimal('min_price');
            $table->decimal('buy_price');
            $table->decimal('sale_price');
            $table->boolean('archived')->default(false);
            $table->boolean('published')->default(true);
            $table->decimal('weight', 10, 3);
            $table->decimal('volume', 10, 3);
            $table->bigInteger('reserve');
            $table->bigInteger('in_transit');
            $table->bigInteger('quantity');
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
        Schema::dropIfExists('products');
    }
}
