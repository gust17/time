<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('consumo_servico', function (Blueprint $table) {
            $table->unsignedBigInteger('cliente_id')->after('user_id'); // Adiciona a coluna após 'user_id'
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade'); // Cria a chave estrangeira
        });
    }
    
    public function down()
    {
        Schema::table('consumo_servico', function (Blueprint $table) {
            $table->dropForeign(['cliente_id']); // Remove a chave estrangeira
            $table->dropColumn('cliente_id'); // Remove a coluna
        });
    }
};
