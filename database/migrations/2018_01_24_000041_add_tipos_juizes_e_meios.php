<?php

use Illuminate\Database\Migrations\Migration;

class AddTiposJuizesEMeios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Meio::truncate();
        \App\Models\Meio::insert(['nome' => 'Físico']);

        \App\Models\Meio::insert(['nome' => 'Eletrônico']);
        \App\Models\Meio::insert(['nome' => 'N/C']);

        \App\Models\TipoJuiz::truncate();
        \App\Models\TipoJuiz::insert(['nome' => 'Ministro']);

        \App\Models\TipoJuiz::insert(['nome' => 'Desembargador']);
        \App\Models\TipoJuiz::insert(['nome' => 'Juiz']);
        \App\Models\TipoJuiz::insert(['nome' => 'N/C']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \App\Models\Meio::truncate();
        \App\Models\Meio::insert(['nome' => 'Físico']);

        \App\Models\Meio::insert(['nome' => 'Eletrônico']);

        \App\Models\TipoJuiz::truncate();
        \App\Models\TipoJuiz::insert(['nome' => 'Ministro']);

        \App\Models\TipoJuiz::insert(['nome' => 'Desembargador']);
        \App\Models\TipoJuiz::insert(['nome' => 'Juiz']);
    }
}
