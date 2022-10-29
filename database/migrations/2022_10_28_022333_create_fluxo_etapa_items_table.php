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
        Schema::create('fluxo_etapa_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255);
            $table->string('slug', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->string('evento', 20)->nullable()->default('defer');
            $table->text('description')->nullable();
            $table->integer('width')->nullable()->default('12');
            $table->integer('visible')->nullable()->default('1');
            $table->integer('ordering')->nullable()->default('0');
            $table->enum('status',['draft','published'])->nullable()->comment("Situação")->default('published');
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
        Schema::dropIfExists('fluxo_etapa_items');
    }
};
