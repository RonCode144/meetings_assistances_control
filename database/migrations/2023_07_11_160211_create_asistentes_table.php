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
        Schema::create('reuasistentes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('reureunion_id');
            $table->string('identificacion', 100);
            $table->string('name', 100);
            $table->string('email');
            $table->longText('firma')->nullable(); //tipo de dato longText = NVARCHAR (MAX) -> Soporta hasta 4GB
            $table->timestamps();
            $table->foreign('reureunion_id')
                ->references('id')
                ->on('reureuniones')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reuasistentes');
    }
};
