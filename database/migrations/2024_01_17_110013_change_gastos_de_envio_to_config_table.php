<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeGastosDeEnvioToConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'config_general', function (Blueprint $table) {
                $table->dropColumn('gastos_de_envio');
                $table->unsignedInteger('gastos_de_envio_id')->nullable();
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
            'config_general', function (Blueprint $table) {
                $table->dropColumn('gastos_de_envio_id');
                $table->unsignedInteger('gastos_de_envio')->nullable();
            }
        );
    }
}
