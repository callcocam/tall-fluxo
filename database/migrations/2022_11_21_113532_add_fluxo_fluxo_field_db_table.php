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
        Schema::table('fluxo_field_dbs', function (Blueprint $table) {
            $table->string('filters')->nullable();  
            $table->string('filters_values')->nullable();  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fluxo_field_dbs', function (Blueprint $table) {
            $table->dropColumn('filters');  
            $table->dropColumn('filters_values');  
        });
    }
};
