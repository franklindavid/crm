<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations. 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id'); 
            $table->datetime('fechainicio');
            $table->datetime('fechafin')->nullable();
            $table->boolean('todoeldia')->nullable();
            $table->string('color')->nullable();
            $table->string('asunto',60); 
            $table->string('informacion',60)->default('sin definir');
//            $table->time('hora');
            $table->string('lugar',60)->default('sin definir');
            $table->timestamps(); 
        });
        
//        Schema::create('event_user',function (blueprint $table){
//            $table->increments('id');
//            $table->integer('user_id')->unsigned();
//            $table->integer('event_id')->unsigned();
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
//            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
//            $table->timestamps();
//        });
        Schema::create('schedule', function (Blueprint $table) {
            $table->increments('id'); 
            $table->datetime('fechainicio');
            $table->datetime('fechafin')->nullable();
            $table->boolean('todoeldia')->nullable();
            $table->string('color')->nullable();
            $table->string('asunto',60); 
            $table->string('informacion',60)->default('sin definir');
            $table->string('lugar',60)->default('sin definir');
            $table->integer('task_id')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
//        Schema::drop('event_user');
        Schema::drop('events');
        Schema::drop('schedule');
        
    }
}
