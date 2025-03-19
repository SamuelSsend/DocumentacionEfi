<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdddescriptionHosteltactilToAlimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'alimento', function (Blueprint $table) {
                $table->renameColumn('descripcion', 'descripcion_manual');
                $table->text('descripcion_hosteltactil')->nullable();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(
            'alimento', function (Blueprint $table) {
                $table->dropColumn('descripcion_hosteltactil');
                $table->renameColumn('descripcion_manual', 'descripcion');
            }
        );
    }
}
