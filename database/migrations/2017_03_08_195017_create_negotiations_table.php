<?php
 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNegotiationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negotiations', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('estado',['en proceso','ganada','perdida'])->default('en proceso');
            $table->text('detalles');
            $table->timestamp('cierre')->nullable();
            $table->string('forma_pago',60);
            $table->integer('total_negociacion');
            $table->integer('client_id')->unsigned();
//            $table->integer('product_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('negotiation_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('negotiation_id')->unsigned();
            $table->foreign('negotiation_id')->references('id')->on('negotiations')->onDelete('cascade');
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');            
            $table->integer('cantidad');
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
        Schema::drop('negotiation_product');
        Schema::drop('negotiations');
        
    }
}
