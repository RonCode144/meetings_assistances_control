<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reureuniones', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('tema', 150);
            $table->string('instructor', 150);
            $table->string('lugar', 250);
            $table->string('responsable', 150);
            $table->string('empresa', 150);
            $table->string('gerencia', 50)->nullable();
            $table->dateTime('fechaInicio');
            $table->dateTime('fechaFinal');
            // $table->string('horaInicio');
            // $table->string('horaFin');
            // $table->string('slug');
            $table->boolean('activo');
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('Users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reureuniones');
    }
};
