<?php

use App\Models\Processo as ProcessoModel;
use Illuminate\Database\Seeder;

class ProcessosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProcessoModel::factory(50)->create();
    }
}
