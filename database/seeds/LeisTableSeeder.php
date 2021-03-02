<?php

use App\Models\Lei as LeiModel;
use App\Models\ProcessoLei as ProcessoLeiModel;
use Illuminate\Database\Seeder;

class LeisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeiModel::factory(50)->create();
        ProcessoLeiModel::factory(300)->create();
    }
}
