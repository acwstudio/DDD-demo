<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateMenuAdministratorsTable
 */
class CreateMenuAdministratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_administrators', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_administrator_id')->nullable();
            $table->string('item');
            $table->string('alias');
            $table->string('icon')->nullable();
            $table->string('route')->nullable();
            $table->string('permission')->nullable();
            $table->string('father')->nullable();
            $table->smallInteger('level')->nullable();
            //$table->timestamps();
            $table->foreign('menu_administrator_id')->references('id')->on('menu_administrators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_administrators');
    }
}
