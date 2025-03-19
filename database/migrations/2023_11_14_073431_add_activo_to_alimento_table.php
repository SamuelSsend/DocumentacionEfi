<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivoToAlimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'menu_comida', function (Blueprint $table) {
                $table->boolean('activo')->default(true)->after('id');
            }
        );

        Schema::table(
            'alimento', function (Blueprint $table) {
                $table->boolean('activo_hosteltactil')->default(true)->after('id');
            }
        );

        Schema::table(
            'subproductos', function (Blueprint $table) {
                $table->boolean('activo_hosteltactil')->default(true)->after('id');
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
            'menu_comida', function (Blueprint $table) {
                $table->dropColumn('activo');
            }
        );

        Schema::table(
            'subproductos', function (Blueprint $table) {
                $table->dropColumn('activo_hosteltactil');
            }
        );

        Schema::table(
            'alimento', function (Blueprint $table) {
                $table->dropColumn('activo_hosteltactil');
            }
        );
    }
}
