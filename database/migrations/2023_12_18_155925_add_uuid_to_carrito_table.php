<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUuidToCarritoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(
            'carrito', function (Blueprint $table) {
                $table->string('uuid')->nullable();
                $table->unsignedInteger('iduser')->nullable()->change();
            }
        );

        Schema::table(
            'pedidos', function (Blueprint $table) {
                $table->string('uuid')->nullable();
                $table->unsignedInteger('iduser')->nullable()->change();
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
            'carrito', function (Blueprint $table) {
                $table->dropColumn('uuid');
                $table->unsignedInteger('iduser')->nullable(false)->change();
            }
        );

        Schema::table(
            'pedidos', function (Blueprint $table) {
                $table->dropColumn('uuid');
                $table->unsignedInteger('iduser')->nullable(false)->change();
            }
        );
    }
}
