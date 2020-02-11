<?php

namespace Tests\Browser;

use App\Data\Repositories\Opinions;
use App\Data\Repositories\Opinions as OpinionsRepository;
use App\Data\Repositories\OpinionSubjects as OpinionSubjectsRepository;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Data\Repositories\OpinionScopes as OpinionScopeRepository;
use App\Data\Repositories\OpinionTypes as OpinionsTypesRepository;
use App\Data\Repositories\ApproveOptions as ApproveOptionsRepository;

class OpinionsTest extends DuskTestCase
{
    private static $opinionScope;
    private static $author;
    private static $opinionType;
    private static $suitNumber;
    private static $suitSheet;
    private static $identifier;
    private static $party;
    private static $abstract;
    private static $opinion;
    private static $approveOption;
    private static $isActive;
    private static $opinionSubject;
    private static $opinionO;
    private static $authorKey;

    public function init()
    {
        $faker = app(Faker::class);

        static::$opinionScope = app(OpinionScopeRepository::class)
            ->randomElement()
            ->toArray();

        $allAuthors = app(OpinionsRepository::class)
            ->getAllAuthors()
            ->toArray();

        static::$authorKey = array_rand($allAuthors);

        static::$author = $allAuthors[static::$authorKey];

        static::$opinionType = app(OpinionsTypesRepository::class)
            ->randomElement()
            ->toArray();

        static::$suitNumber = (string) $faker->randomNumber(4);
        static::$suitSheet = (string) $faker->randomNumber(4);
        static::$identifier = (string) $faker->randomNumber(4);
        static::$party = only_letters_and_space($faker->name);
        static::$abstract = only_letters_and_space($faker->name);
        static::$opinion = only_letters_and_space($faker->name);
        static::$approveOption = app(ApproveOptionsRepository::class)
            ->randomElement()
            ->toArray();
    }

    //    public function testInsert()
    //    {
    //        $this->init();
    //
    //        $opinionScopeO = static::$opinionScope;
    //        $authorKeyO = static::$authorKey;
    //        $authorO = static::$author;
    //        $opinionTypeO = static::$opinionType;
    //        $suitNumberO = static::$suitNumber;
    //        $suitSheetO = static::$suitSheet;
    //        $identifierO = static::$identifier;
    //        $partyO = static::$party;
    //        $opinionO = static::$opinion;
    //        $approveOptionO = static::$approveOption;
    //
    //        $this->browse(function (Browser $browser) use (
    //            $opinionScopeO,
    //            $authorKeyO,
    //            $opinionTypeO,
    //            $suitNumberO,
    //            $suitSheetO,
    //            $identifierO,
    //            $partyO,
    //            $opinionO,
    //            $authorO,
    //            $approveOptionO
    //        ) {
    //            $browser = $this->loginPareceres($browser, false, 'Pareceres');
    //
    //            $browser
    //
    //                ->clickLink('Novo')
    //                ->select('#opinion_scope_id', $opinionScopeO['id'])
    //                ->script("$('#authorable-select').val($authorKeyO);
    //                $('#authorable-select').trigger({
    //        type: 'select2:select',
    //        params: {
    //                    data: {id: $authorKeyO}
    //                }
    //    });");
    //            $browser
    //                ->screenshot('ihgfufhguha')
    //                ->select('#approve_option_id', $approveOptionO['id'])
    //                ->select('#opinion_type_id', $opinionTypeO['id'])
    //                ->type('#suit_number', $suitNumberO)
    //                ->type('#suit_sheet', $suitSheetO)
    //                ->type('#identifier', $identifierO)
    //                ->keys('#date', '01/01/2000')
    //                ->type('#party', $partyO)
    //                ->type('#abstract', 'teste')
    //                ->type('#opinion', $opinionO)
    //                ->screenshot('testando')
    //                ->press('#gravar')
    //                ->waitForText(
    //                    'Gravado com sucesso. Insira os assuntos correspondentes.',
    //                    10
    //                )
    //                ->waitForText($opinionScopeO)
    //                ->assertSee($opinionScopeO['name'])
    //                ->assertSee($authorO['name'])
    //                ->assertSee($approveOptionO['name'])
    //                ->assertSee($opinionTypeO['name'])
    //                ->screenshot('TestInsert');
    //        });
    //    }
    //
    //    public function testValidation()
    //    {
    //        $this->browse(function (Browser $browser) {
    //            $browser
    //                ->visit('/pareceres')
    //                ->maximize()
    //                ->clickLink('Novo')
    //                ->select('#abstract', '')
    //                ->press('Gravar')
    //                ->assertSee('O campo Abrangência é obrigatório.')
    //                ->assertSee('O campo Procurador é obrigatório.')
    //                ->assertSee('O campo Tipo é obrigatório.')
    //                ->assertSee('O campo Data é obrigatório.')
    //                ->assertSee('O campo Ementa é obrigatório.')
    //                ->screenshot('TestValidation');
    //        });
    //    }
    //
    //    public function testRightSearch()
    //    {
    //        $this->init();
    //
    //        $opinionScopeO = static::$opinionScope;
    //
    //        $this->browse(function (Browser $browser) use ($opinionScopeO) {
    //            $browser
    //                ->visit('/pareceres')
    //                ->maximize()
    //                ->type('pesquisa', $opinionScopeO['name'])
    //                ->click('#searchButton')
    //                ->waitForText($opinionScopeO)
    //                ->assertSee($opinionScopeO['name'])
    //                ->screenshot('TestRightSearch');
    //        });
    //    }
    //
    //    public function testSearchWithCheckBox()
    //    {
    //        $this->init();
    //
    //        $opinionScopeO = static::$opinionScope;
    //        $isActiveO = static::$isActive;
    //
    //        $this->browse(function (Browser $browser) use (
    //            $opinionScopeO,
    //            $isActiveO
    //        ) {
    //            $browser
    //                ->visit('/pareceres')
    //                ->maximize()
    //                ->type('pesquisa', $opinionScopeO['name'])
    //                ->check('show-inactive')
    //                ->click('#searchButton')
    //                ->waitForText($opinionScopeO)
    //                ->assertSee($opinionScopeO['name'])
    //                ->assertNotChecked($isActiveO)
    //                ->screenshot('TestSearchWithCheckbox');
    //        });
    //    }
    //
    //    public function testWrongSearch()
    //    {
    //        $this->browse(function (Browser $browser) {
    //            $browser
    //                ->visit('/pareceres')
    //                ->type('pesquisa', '132312312vcxvdsf413543445654')
    //                ->click('#searchButton')
    //                ->waitForText('Nenhum parecer encontrado')
    //                ->screenshot('wrongsearch')
    //                ->assertSee('Nenhum parecer encontrado')
    //                ->screenshot('TestWrongSearch');
    //        });
    //    }
    //
    //    public function testAlter()
    //    {
    //        $this->init();
    //
    //        $opinionAdress = app(OpinionsRepository::class)
    //            ->randomElement()
    //            ->toArray();
    //        $novoOpinionScopeO = static::$opinionScope;
    //        $novoAuthorKeyO = static::$authorKey;
    //        $novoOpinionType = static::$opinionType;
    //        $novoSuitNumber = static::$suitNumber;
    //        $novoSuitSheet = static::$suitSheet;
    //        $novoIdentifier = static::$identifier;
    //        $novoParty = static::$party;
    //        $novoApproveOption = static::$approveOption;
    //        $novoAuthor = static::$author;
    //
    //        $this->browse(function (Browser $browser) use (
    //            $opinionAdress,
    //            $novoOpinionScopeO,
    //            $novoAuthorKeyO,
    //            $novoOpinionType,
    //            $novoSuitNumber,
    //            $novoSuitSheet,
    //            $novoIdentifier,
    //            $novoParty,
    //            $novoAuthor,
    //            $novoApproveOption
    //        ) {
    //            $browser
    //                ->visit('/pareceres/' . $opinionAdress['id'])
    //                ->click('#editar')
    //                ->select('#opinion_scope_id', $novoOpinionScopeO['id'])
    //                ->script(
    //                    "$('#authorable-select').val($novoAuthorKeyO);
    //                $('#authorable-select').trigger({
    //        type: 'select2:select',
    //        params: {
    //                    data: {id: $novoAuthorKeyO}
    //                }
    //    });"
    //                );
    //            $browser
    //                ->select('#approve_option_id', $novoApproveOption['id'])
    //                ->select('#opinion_type_id', $novoOpinionType['id'])
    //                ->type('#suit_number', $novoSuitNumber)
    //                ->type('#suit_sheet', $novoSuitSheet)
    //                ->type('#identifier', $novoIdentifier)
    //                ->keys('#date', '04/03/2015')
    //                ->type('#party', $novoParty)
    //                ->type('#abstract', 'testando')
    //                ->type('#opinion', 'testando123')
    //                ->press('Gravar')
    //                ->waitForText(
    //                    'Gravado com sucesso. Insira os assuntos correspondentes.',
    //                    10
    //                )
    //                ->waitForText($novoOpinionScopeO)
    //                ->assertSee($novoOpinionScopeO['name'])
    //                ->assertSee($novoAuthor['name'])
    //                ->assertSee($novoApproveOption['name'])
    //                ->assertSee($novoOpinionType['name'])
    //                ->screenshot('TestAlter');
    //        });
    //    }

    public function initSubject()
    {
        static::$opinionSubject = app(
            OpinionSubjectsRepository::class
        )->notRootRandomElement();

        static::$opinionO = app(OpinionsRepository::class)->randomElement();

        self::$opinionO->unrelateSubject(self::$opinionSubject->id);
    }

    public function testRelateSubject()
    {
        $this->initSubject();

        $opinionO = static::$opinionO;
        $opinionSubjectO = static::$opinionSubject;

        $this->browse(function (Browser $browser) use (
            $opinionSubjectO,
            $opinionO
        ) {
            $browser = $this->loginPareceres($browser, false, 'Pareceres');

            $browser

                ->visit('/pareceres/' . $opinionO->id)
                ->driver->executeScript('window.scrollTo(0, 500);');

            $browser

                ->click('#relacionar-assunto')
                ->waitForText('Root', 10)
                ->script(
                    'document.getElementById("value-input").value = ' .
                        $opinionSubjectO->id
                );
            $browser

                ->waitForText($opinionSubjectO->name, 10)
                ->assertSeeIn('#subjectsTreeSelect', $opinionSubjectO->name)
                ->click('#buttonRelacionarLei')
                ->waitForText('Gravado com sucesso', 10)
                ->waitForText($opinionSubjectO->name)
                ->assertSee($opinionSubjectO->name)
                ->screenshot('TestRelateSubject');
        });
    }
}
