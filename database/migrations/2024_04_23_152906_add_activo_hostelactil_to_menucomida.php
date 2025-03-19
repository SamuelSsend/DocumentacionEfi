<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActivoHostelactilToMenucomida extends Migration
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
                if (!Schema::hasColumn('menu_comida', 'activo_hosteltactil')) {
                    $table->boolean('activo_hosteltactil')->default(true)->after('id');
                }
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
                if (Schema::hasColumn('menu_comida', 'activo_hosteltactil')) {
                    $table->dropColumn('activo_hosteltactil');
                }
            }
        );
    }
}