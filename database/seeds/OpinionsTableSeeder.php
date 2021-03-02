<?php

use App\Models\Opinion as OpinionModel;
use App\Models\OpinionsSubject as OpinionsSubjectModel;
use Illuminate\Database\Seeder;
use App\Data\Models\OpinionSubject;
class OpinionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OpinionModel::class, 50)->create();
        //factory(OpinionSubject::class, 50)->create();
        factory(OpinionsSubjectModel::class, 300)->create();
    }
}
