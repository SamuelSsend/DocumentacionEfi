<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFields2ToPedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'pedidos', function (Blueprint $table) {
                $table->string('name')->nullable();
                $table->string('email')->nullable();
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
            'pedidos', function (Blueprint $table) {
                $table->dropColumn('name');
                $table->dropColumn('email');
            }
        );
    }
}
