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
        Schema::create('fluxo_etapa_menssages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome_produto', 255);
            $table->string('slug', 255)->nullable();
            $table->string('cod_barras', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('ordering')->nullable()->default('0');
            $table->foreignUuid('fluxo_etapa_back_id')->nullable()->constrained('fluxo_etapas')->cascadeOnDelete();        
            $table->foreignUuid('fluxo_etapa_id')->nullable()->constrained('fluxo_etapas')->cascadeOnDelete();        
            $table->foreignUuid('user_id')->nullable()->constrained('users')->cascadeOnDelete();        
            $table->foreignUuid('tenant_id')->nullable()->constrained('tenants')->cascadeOnDelete();        
            $table->timestamps();
            $table->softDeletes();    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fluxo_etapa_menssages');
    }
};
