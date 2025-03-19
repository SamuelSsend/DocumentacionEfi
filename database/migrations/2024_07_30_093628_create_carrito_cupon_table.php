<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarritoCuponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'carrito_cupon', function (Blueprint $table) {
                $table->increments('id'); // Cambiar a increments para int(11)
                $table->unsignedInteger('carrito_id'); // Cambiar a unsignedInteger para int(11)
                $table->unsignedInteger('cupon_id'); // Cambiar a unsignedInteger para int(11)
                $table->timestamps();
            
                $table->foreign('carrito_id')->references('id')->on('carrito')->onDelete('cascade');
                $table->foreign('cupon_id')->references('id')->on('cupon')->onDelete('cascade');
                $table->engine = 'InnoDB';
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
            'carrito_cupon', function (Blueprint $table) {
                $table->dropForeign(['carrito_id']);
                $table->dropForeign(['cupon_id']);
            }
        );
        Schema::dropIfExists('carrito_cupon');
    }
}
