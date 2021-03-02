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
        factory(LeiModel::class, 50)->create();
        factory(ProcessoLeiModel::class, 300)->create();
    }
}
