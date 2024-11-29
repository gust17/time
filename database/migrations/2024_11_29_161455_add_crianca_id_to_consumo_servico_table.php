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
            $table->unsignedBigInteger('crianca_id')->after('id');
        });
    }
    
    public function down()
    {
        Schema::table('consumo_servico', function (Blueprint $table) {
            $table->dropColumn('crianca_id');
        });
    }
};
