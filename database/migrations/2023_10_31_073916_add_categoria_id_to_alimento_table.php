<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriaIdToAlimentoTable extends Migration
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
                $table->foreignId('categoria_id')
                    ->after('categoria')
                //  ->constrained()
                    ->nullable();
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
                //            $table->dropForeign('categoria_id');
                $table->dropColumn('categoria_id');
            }
        );
    }
}
