                                                                    <?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',60); 
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->enum('estado',['prospecto','cliente'])->default('prospecto');
            $table->enum('tipo',['empresa','persona'])->default('persona');
            $table->string('direccion',60);
            $table->string('telefono',60);
            $table->enum('sexo',['masculino','femenino','indefinido'])->default('indefinido');
            $table->string('cedula',60);
            $table->boolean('whatsapp');            
            $table->string('email',60);
            $table->text('comentarios',60);
            $table->integer('oportunidad');
            $table->timestamps();
        });
        
//        Schema::create('client_refer', function (Blueprint $table) {
//            $table->increments('id');
//            $table->integer('refer_id')->unsigned();
//            $table->foreign('refer_id')->references('id')->on('clients')->onDelete('cascade');
//            $table->integer('client_id')->unsigned();
//            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
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
//        Schema::drop('client_refer');
        Schema::drop('clients');        
    }
}
