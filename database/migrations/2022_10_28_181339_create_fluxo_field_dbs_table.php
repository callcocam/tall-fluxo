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
        Schema::create('fluxo_field_dbs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->nullable();
            $table->string('view')->default('db-select')->nullable();
            $table->text('slug')->nullable();
            $table->enum('type', ['hasOne','hasMany','belongsTo','belongsToMany'])->default('belongsTo');
            $table->string('key_name')->nullable()->default('id'); 
            $table->string('columns')->nullable()->default('name'); 
            $table->string('model')->nullable(); 
            $table->text('description')->nullable(); 
            $table->enum('status',['draft','published'])->nullable()->comment("Situação")->default('published');
            $table->foreignUuid('fluxo_field_id')->nullable()->constrained('fluxo_fields')->cascadeOnDelete();        
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
        Schema::dropIfExists('fluxo_field_dbs');
    }
};
