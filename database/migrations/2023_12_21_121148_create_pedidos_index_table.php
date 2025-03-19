<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosIndexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'pedidos_index', function (Blueprint $table) {
                $table->id();
                $table->string('uuid');
                $table->timestamps();
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
                $table->dropColumn('activo_hosteltactil');
            }
        );
    }
}
