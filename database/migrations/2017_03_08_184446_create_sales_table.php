<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//         Schema::create('sales', function (Blueprint $table) {
//            $table->increments('id');            
//            $table->integer('client_id')->unsigned();
//            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
//            $table->integer('user_id')->unsigned();
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->integer('product_id')->unsigned();
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
//            $table->string('forma_pago',60);            
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::drop('sales');
    }
}
