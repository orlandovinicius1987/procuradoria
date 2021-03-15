<?php

namespace Tests\Browser;

use App\Data\Repositories\Opinions as OpinionsRepository;
use App\Models\OpinionSubject as OpinionSubjectModel;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Data\Repositories\OpinionsSubjects as OpinionsSubjectsRepository;
use App\Data\Repositories\OpinionSubjects as OpinionSubjectsRepository;

class SubjectsTest extends DuskTestCase
{
    private static $newOpinionSubjectInfo;
    private static $subjectReplace;

    public function init()
    {
        static::$newOpinionSubjectInfo = factory(
            OpinionSubjectModel::class
        )->raw();

        static::$subjectReplace = app(OpinionSubjectsRepository::class)
            ->notRootRandomElement()
            ->toArray();
    }

    public function testInsert()
    {
        $this->init();

        $newOpinionSubjectInfoO = static::$newOpinionSubjectInfo;


        $this->browse(function (Browser $browser) use (
            $newOpinionSubjectInfoO
        ) {
            $browser = $this->loginPareceres($browser, false, 'Pareceres');

           // dd(OpinionSubjectModel::find($newOpinionSubjectInfoO['parent_id']));

            $browser
                ->visit('/assuntos')
                ->clickLink('Novo')
                ->script(
                    'document.getElementById("value-input").value = ' .
                        $newOpinionSubjectInfoO['parent_id']
                );
            $browser
                ->type('#name', $newOpinionSubjectInfoO['name'])
                ->press('#gravar')
                ->waitForText($newOpinionSubjectInfoO['name'])
                ->assertSee($newOpinionSubjectInfoO['name'])
                ->screenshot('TestInsertSubjects');
        });
    }

    public function testValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser = $this->loginPareceres($browser, false, 'Pareceres');

            $browser
                ->visit('/assuntos')
                ->clickLink('Novo')
                ->waitForText('Gravar')
                ->waitFor('#select2-subjectsTreeSelect-container', 10)
//                ->waitForText('Root')
//                ->pause(5)
                ->press('#gravar')
                ->waitForText('O campo Nome é obrigatório.', 5)
                ->assertSee('O campo Nome é obrigatório.')
                ->screenshot('ValidationSubject');
        });
    }

    public function testAlter()
    {
        $newTradeOpinionSubjectInfoO = static::$newOpinionSubjectInfo;
        $newSubjectReplace = static::$subjectReplace;

        $this->browse(function (Browser $browser) use (
            $newTradeOpinionSubjectInfoO,
            $newSubjectReplace
        ) {
            $browser = $this->loginPareceres($browser, false, 'Pareceres');

            $subjectReplaceAble = app(
                OpinionSubjectsRepository::class
            )->randomElementNotDescendant($newSubjectReplace['id']);

            $browser
                ->visit('/assuntos/' . $subjectReplaceAble->id)
                ->click('#editar')
                ->script(
                    'document.getElementById("value-input").value = ' .
                        $newTradeOpinionSubjectInfoO['parent_id']
                );
            $browser
                ->type('#name', $newTradeOpinionSubjectInfoO['name'])
                ->click('#gravar')
                ->waitForText($newTradeOpinionSubjectInfoO['name'], 10)
                ->assertSee($newTradeOpinionSubjectInfoO['name'])
                ->screenshot('TestAlterSubjects');
        });
    }
}
