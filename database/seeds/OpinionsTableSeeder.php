<?php

use App\Models\Opinion as OpinionModel;
use App\Models\OpinionsSubject as OpinionsSubjectModel;
use Illuminate\Database\Seeder;

class OpinionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OpinionModel::factory(50)->create();
        OpinionsSubjectModel::factory(300)->create();
    }
}
