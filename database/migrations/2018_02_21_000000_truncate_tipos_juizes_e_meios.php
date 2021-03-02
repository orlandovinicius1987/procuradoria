<?php

use Illuminate\Database\Migrations\Migration;

class TruncateTiposJuizesEMeios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \App\Models\Meio::truncate();
        \App\Models\TipoJuiz::truncate();
    }
}
