<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('breed');
            $table->string('image');
            $table->text('info');
            $table->enum('season',['spring','summer','autumn', 'winter']);
            $table->enum('water',['spring','avrage','autumn', 'winter']);
            $table->enum('sun',['shade','sun','both', 'winter']);
            $table->enum('environment',['indoor','outdoor','both']);
            $table->float('hight');
            $table->string('provider');
            $table->boolean('available');
            $table->integer('likes');
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
