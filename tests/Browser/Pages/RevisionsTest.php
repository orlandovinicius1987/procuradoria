<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Data\Repositories\ApproveOptions as ApproveOptionsRepository;
use App\Data\Repositories\Opinions as OpinionsRepository;
use App\Data\Repositories\OpinionScopes as OpinionScopeRepository;
use App\Data\Repositories\OpinionTypes as OpinionsTypesRepository;
use App\Data\Repositories\Users as UsersRepository;
use Faker\Generator as Faker;
use App\Data\Repositories\Revisions as RevisionsRepository;

class RevisionsTest extends DuskTestCase
{
    private static $revisionO;

    public function init()
    {
        static::$revisionO = app(RevisionsRepository::class)
            ->randomElement()
            ->toArray();
    }

    public function getLastRevision()
    {
        return app(RevisionsRepository::class)->last();
    }

    public function testVisit()
    {
        $this->browse(function (Browser $browser) {
            $browser = $this->loginPareceres($browser, false, 'Pareceres');
            $browser->visit('/revisions')->assertSee('Revisões');
        });
    }

    public function testCheckRevision()
    {
        $faker = app(Faker::class);
        $opinionO = app(OpinionsRepository::class)
            ->randomElement()
            ->toArray();

        $allAuthors = app(OpinionsRepository::class)
            ->getAllAuthors()
            ->toArray();

        $authorKey = array_rand($allAuthors);

        $novoOpinionScopeO = app(OpinionScopeRepository::class)
            ->randomElement()
            ->toArray();

        $novoOpinionType = app(OpinionsTypesRepository::class)
            ->randomElement()
            ->toArray();

        $novoSuitNumber = (string) $faker->randomNumber(4);
        $novoSuitSheet = (string) $faker->randomNumber(4);
        $novoIdentifier = (string) $faker->randomNumber(4);
        $novoParty = only_letters_and_space($faker->name);
        $novoAbstract = only_letters_and_space($faker->name);
        $novoOpinion = only_letters_and_space($faker->name);

        $novoApproveOption = app(ApproveOptionsRepository::class)
            ->randomElement()
            ->toArray();

        $this->init();

        $revision = static::$revisionO;

        $this->browse(function (Browser $browser) use (
            $opinionO,
            $novoOpinionScopeO,
            $authorKey,
            $novoOpinionType,
            $novoSuitNumber,
            $novoSuitSheet,
            $novoIdentifier,
            $novoParty,
            $novoAbstract,
            $novoOpinion,
            $novoApproveOption
        ) {
            $browser
                ->visit('/pareceres/' . $opinionO['id'])
                ->click('#editar')
                ->select('#opinion_scope_id', $novoOpinionScopeO['id'])
                ->script(
                    "$('#authorable-select').val($authorKey);
            $('#authorable-select').trigger({
    type: 'select2:select',
    params: {
                data: {id: $authorKey}
            }
});"
                );
            $browser
                ->select('#approve_option_id', $novoApproveOption['id'])
                ->select('#opinion_type_id', $novoOpinionType['id'])
                ->type('#suit_number', $novoSuitNumber)
                ->type('#suit_sheet', $novoSuitSheet)
                ->type('#identifier', $novoIdentifier)
                ->keys('#date', '04/03/2015')
                ->type('#party', $novoParty)
                ->type('#abstract', $novoAbstract)
                ->type('#opinion', $novoOpinion)
                ->press('Gravar')
                ->waitForText(
                    'Gravado com sucesso. Insira os assuntos correspondentes.',
                    10
                )
                ->waitForText($novoOpinionScopeO)
                ->assertSee($novoOpinionScopeO['name'])
                ->assertSee($novoApproveOption['name'])
                ->assertSee($novoOpinionType['name'])
                ->visit('/revisions')
                ->clickLink($this->getLastRevision()->id);
            $browser
                ->waitForText($novoIdentifier)
                ->assertSee($novoIdentifier)
                ->screenshot('TestCheckLink');
        });
    }
}
