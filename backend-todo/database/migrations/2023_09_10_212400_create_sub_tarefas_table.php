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
        Schema::create('sub_tarefas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarefa_id');
            $table->foreign('tarefa_id')
                ->references('id')
                ->on('tarefas')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->longText('descricao');
            $table->enum('status', ['Pendente', 'Completa']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tarefas');
    }
};
