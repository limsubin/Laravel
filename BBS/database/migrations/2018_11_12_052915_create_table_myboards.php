<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMyboards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('myboards', function (Blueprint $table) {
            $table->increments('Num');
            $table->string('Title',40);
            $table->string('Writer',20);
            $table->text('Content',20);
            $table->timestamp('Regtime')->default(now());
            $table->integer('Hits')->unsigned()->default(0);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('myboards');
    }
}
