<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Opinion as OpinionModel;
use App\Models\User as UserModel;
use App\Models\OpinionAuthor as OpinionAuthorModel;

class PolymorphicAuthorRefactor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opinions', function (Blueprint $table) {
            $table->renameColumn('attorney_id', 'authorable_id');
            $table->string('authorable_type')->default(UserModel::class)->unsigned();
        });

        Schema::create('opinion_authors', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');

            $table->timestamps();
        });

        $newRow = new OpinionAuthorModel();
        $newRow->name = 'Assessoria';
        $newRow->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opinion_authors');

        OpinionModel::where('authorable_type', UserModel::class)->update(['authorable_id' => null]);

        Schema::table('opinions', function (Blueprint $table) {
            $table->renameColumn('authorable_id', 'attorney_id');
            $table->dropColumn('authorable_type');
        });
    }
}
