<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterOpinionsNullableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('opinions', function (Blueprint $table) {
            $table
                ->text('file_pdf')
                ->nullable()
                ->change();

            $table
                ->text('file_doc')
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('opinions', function (Blueprint $table) {
            $table
                ->text('file_pdf')
                ->nullable(false)
                ->change();

            $table
                ->text('file_doc')
                ->nullable(false)
                ->change();
        });
    }
}
