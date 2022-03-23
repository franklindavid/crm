<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name',60);
            $table->integer('stock_min')->nullable();;
            $table->integer('cantidad')->nullable();;
            $table->double('precio_fabrica', 15, 2)->nullable();;
//            $table->float('precio_fabrica')
//            $table->float('precio_venta');
            $table->double('precio_venta', 15, 2);
            $table->text('descripcion')->nullable();;
            $table->integer('flag');
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
        Schema::drop('products');
    }
}
