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
        Schema::create('fluxo_etapa_produtos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('ordering')->nullable()->default('0');
            $table->enum('status',['draft','published'])->nullable()->comment("Situação")->default('published');
            $table->foreignUuid('fluxo_id')->nullable()->constrained('fluxos')->cascadeOnDelete();        
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
        Schema::dropIfExists('fluxo_etapa_produtos');
    }
};
