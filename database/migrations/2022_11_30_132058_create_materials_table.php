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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('sala')->required();
            $table->string('descricao')->required();
            $table->string('tombo')->default('-');
            $table->string('orgao')->default('-');
            $table->string('marca')->default('-');
            $table->string('modelo')->default('-');
            $table->string('responsavel')->default('-');
            $table->string('origem')->default('-');
            $table->string('estado')->default('-');
            $table->text('observacao')->nullable();

            $table->unsignedBigInteger('user_id');

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
        Schema::dropIfExists('materials');
    }
};
