<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Data\Models\OpinionSubject;
use App\Data\Models\OpinionsSubject;

class RemoveWrongSubject extends Migration
{
    private $id = 41;
    private $name = '---';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $findId = OpinionSubject::find($this->id);
        $findName = OpinionSubject::where('name',$this->name)->first();

        if($findId && $findName && $findName->id == $findId->id){
            dump('Found subject with id='.$this->id.' and name='.$this->name);

            OpinionsSubject::where('subject_id',$findId->id)->get()->each(function($item) use ($findId){
                dump('Found relation with id='.$item->id.', subject_id='.$findId->id);
                $item->delete();
                dump('Removed relation with id='.$item->id.', subject_id='.$findId->id);
            });

            $findId->delete();
            dump('Removed subject with id='.$this->id.' and name='.$this->name);
        }else{
            dump('Not found any subject with id='.$this->id.' and name='.$this->name);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Can't go back
    }
}
