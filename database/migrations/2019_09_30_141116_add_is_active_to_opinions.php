<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsActiveToOpinions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approve_options', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->timestamps();
        });

        DB::table('approve_options')->insert([
            'name' => 'Não há informação'
        ]);
        DB::table('approve_options')->insert(['name' => 'SIM']);
        DB::table('approve_options')->insert(['name' => 'NÃO']);

        Schema::table('opinions', function ($table) {
            $table->boolean('is_active')->default(true);
            $table
                ->integer('approve_option_id')
                ->unsigned()
                ->nullable();
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
            $table->dropColumn('is_active');
            $table->dropColumn('approve_option_id');
        });

        Schema::drop('approve_options');
    }
}
