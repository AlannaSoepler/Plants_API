<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creating a new database table. This function accepts 2 parameters, the table name, 
     * the other is the blueprint object that is used to define the table 
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('breed');
            $table->string('image')->nullable();
            $table->text('info');
            $table->enum('season',['spring','summer','autumn', 'winter'])->default('spring');
            $table->float('hight');
            $table->string('provider');
            $table->integer('likes')->nullable();
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
        Schema::dropIfExists('plants');
    }
};
