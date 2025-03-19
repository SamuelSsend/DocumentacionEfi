<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHosteltactilconfigToConfigGeneralTable extends Migration
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
                $table->string('hosteltactil_api')->nullable();
                $table->string('hosteltactil_token', 4000)->nullable();
                $table->string('hosteltactil_idlocal')->nullable();
                $table->unsignedInteger('hosteltactil_tarifa')->default(1);
            }
        );

        $config = \App\ConfigGeneral::first();
        $config->hosteltactil_api = 'http://46.183.119.158:20200/api';
        $config->hosteltactil_token = "HjtBBUCxd6mNkxApKo3GNXyPdLMFbF35wJ6pt_Q-FDrv2-Ubl2551Sdz_NseNb81q8p97usjLagA63WFaKw4nxxlr2gcBozU119HGvysts0q09XLcI4pjlHUWWFO0yUG3hDfNmaCYfDeridsdZvJGngxKxAAgb20NL-BRaFroZVgcer9sbaj-mt9OkSGYj3WpAV5_3P37ylGNqZuxItgHekb669gvpugxg3cYdTuS0oE_9HDRmd-zOVd-lyBgK3A_ZO7rW-PmDRFqWxhusuFJdbHJNtAyjGUpuPDsA1w-h6_cghOejzfh87M87czU-3sLvqKRUFgAj_3P0H3QElJVFFI-ULkzxG4yiXRA4hgXI2LQbEPR1ishGx_vjfZ3Xm8tFgpBLhUr4nDINdzu8XRUxoEvNCVOUbCaK1IwLb7saPlluQAiJ8ZdzN57qarpw9-0YooeaxgVACinyPYQuuIJvct9mk7DKpJHOvbZMZH1og";
        $config->hosteltactil_idlocal = 1143;
        $config->hosteltactil_tarifa = 1;
        $config->save();
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
                $table->dropColumn('hosteltactil_api');
                $table->dropColumn('hosteltactil_token');
                $table->dropColumn('hosteltactil_idlocal');
                $table->dropColumn('hosteltactil_tarifa');
            }
        );
    }
}
