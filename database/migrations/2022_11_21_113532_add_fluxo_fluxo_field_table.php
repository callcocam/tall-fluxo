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
        Schema::create('fluxo_fluxo_field', function (Blueprint $table) {
            $table->foreignUuid('fluxo_id')->nullable()->constrained('fluxos')->cascadeOnDelete();  
            $table->foreignUuid('fluxo_field_id')->nullable()->constrained('fluxo_fields')->cascadeOnDelete();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fluxo_fluxo_field');
    }
};
