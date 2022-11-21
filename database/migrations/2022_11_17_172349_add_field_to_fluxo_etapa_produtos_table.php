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
        Schema::table('fluxo_etapa_produtos', function (Blueprint $table) {
              $table->text('nome_produto')->nullable()->after('id');
              $table->string('cod_barras', '255')->nullable()->after('nome_produto');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fluxo_etapa_produtos', function (Blueprint $table) {
            //
        });
    }
};
