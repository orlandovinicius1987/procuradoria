<?php

use App\Data\Models\Busca;
use App\Data\Models\Processo;
use App\Data\Models\Opinion;
use App\Data\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Data\Models\Revision;

class AlterTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


            $duplicateRecords = DB::table('users')
                    ->selectRaw('lower(email) as email,count(*)')
                    ->groupBy(DB::raw('lower(email)'))
                    ->havingRaw('count(*)>1')
                    ->get();

            //dump($duplicateRecords);


        foreach($duplicateRecords as $record) {
            $users = User::where('email', 'ilike', $record->email)->orderBy('id')->get();
            $userTrue = $users[0];
            foreach ($users as $user) {
                if ($user->id == $userTrue->id) {
                    continue;
                }

                else {
                    $processosProcurador = Processo::where('procurador_id', '=', $user->id)->get();
                    $processosEstagiario = Processo::where('estagiario_id', '=', $user->id)->get();
                    $processosAssessor = Processo::where('assessor_id', '=', $user->id)->get();
                    $attorneyUser = Opinion::where('attorney_id','=',$user->id)->get();
                    $createdBy = Opinion::where('created_by','=',$user->id)->get();
                    $updatedBy = Opinion::where('updated_by','=',$user->id)->get();
                    $importedBy = Busca::where('imported_by_id','=',$user->id)->get();
                    $ignoredBy = Busca::where('ignored_by_id','=',$user->id)->get();
                    $disabledBy = User::where('disabled_by_id','=',$user->id)->get();
                    $revisionId = Revision::where('user_id','=',$user->id)->get();


                 $processosProcurador->each(function ($processo)use($userTrue){
                     $processo->procurador_id = $userTrue->id;
                     $processo->save();
                 });

                  $processosEstagiario->each(function ($processo)use($userTrue) {
                      $processo->estagiario_id = $userTrue->id;
                      $processo->save();
                  });

                   $processosAssessor->each(function ($processo)use($userTrue) {
                       $processo->assessor_id = $userTrue->id;
                       $processo->save();
                   });

                    $attorneyUser->each(function ($opinion)use($userTrue) {
                        $opinion->attorney_id = $userTrue->id;
                        $opinion->save();
                    });

                    $createdBy->each(function ($opinion)use($userTrue) {
                        $opinion->created_by = $userTrue->id;
                        $opinion->save();
                    });

                    $updatedBy->each(function ($opinion)use($userTrue) {
                        $opinion->updated_by = $userTrue->id;
                        $opinion->save();
                    });

                   $importedBy->each(function ($busca)use($userTrue) {
                        $busca->imported_by_id = $userTrue->id;
                        $busca->save();
                    });

                    $ignoredBy->each(function ($busca)use($userTrue) {
                        $busca->ignored_by_id = $userTrue->id;
                        $busca->save();
                    });

                    $disabledBy->each(function ($disable)use($userTrue) {
                        $disable->disabled_by_id = $userTrue->id;
                        $disable->save();
                    });

                    $revisionId->each(function ($revision)use($userTrue) {
                        $revision->user_id = $userTrue->id;
                        $revision->save();
                    });

//                    User::where('id', '=', $user->id)->delete();
                    $user->delete();
                }

                $userTrue->email =  Str::lower($userTrue->email);
                $userTrue->save();



            }
        }


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
