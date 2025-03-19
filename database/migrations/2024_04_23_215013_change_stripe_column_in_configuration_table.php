<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeStripeColumnInConfigurationTable extends Migration
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
                $table->string('stripe_public', 4000)->nullable()->change();
                $table->string('stripe_private', 4000)->nullable()->change();
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
                // nope
            }
        );
    }
}
