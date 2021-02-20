<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCustomcards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customcards', function (Blueprint $table) {
            $table->increments('custom_number');
            $table->string('id',20);
            $table->string('positive_perfume',20);
            $table->tinyInteger('positive_strength');
            $table->string('normal_perfume',20);
            $table->tinyInteger('normal_strength');
            $table->string('nagative_perfume',20);
            $table->tinyInteger('nagative_strength');
            $table->text('rgb');
            $table->decimal('opacity',2,1);
            $table->date('indate')->default(date('Y-m-d'),today());;

            $table->foreign('id')->references('id')->on('member');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customcards');
    }
}
