<?php

namespace Tests\Browser;

use App\Data\Repositories\Acoes as AcoesRepository;
use App\Data\Repositories\Juizes as JuizesRepository;
use App\Data\Repositories\Meios as MeiosRepository;
use App\Data\Repositories\Processos as ProcessosRepository;
use App\Data\Repositories\Tribunais as TribunaisRepository;
use App\Data\Repositories\Users as UsersRepository;
use App\Support\Constants;
use Faker\Generator as Faker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Carbon\Carbon;

class ProcessosTest extends DuskTestCase
{
    private static $numeroJudicialProcesso;
    private static $numeroAlerjProcesso;
    private static $tribunalProcesso;
    private static $varaProcesso;
    private static $dataDistribuicaoProcesso;
    private static $acaoProcesso;
    private static $juizProcesso;
    private static $autorProcesso;
    private static $relatorProcesso;
    private static $reuProcesso;
    private static $procuradorProcesso;
    private static $estagiarioProcesso;
    private static $assessorProcesso;
    private static $tipoMeioProcesso;
    private static $objetoProcesso;
    private static $ementaProcesso;
    private static $meritoProcesso;
    private static $liminarProcesso;
    private static $apensosObsProcesso;
    private static $recursoObsProcesso;
    private static $observacaoProcesso;
    private static $linkProcesso;

    public function randomAcceptableDate()
    {
        $faker = app(Faker::class);
        return Carbon::createFromFormat(
            'd-m-Y',
            $faker->numberBetween(1, 28) .
                '-' .
                $faker->numberBetween(1, 12) .
                '-' .
                $faker->numberBetween(2000, 3000)
        );
    }

    public function init()
    {
        $faker = app(Faker::class);
        static::$numeroJudicialProcesso = $faker->randomNumber();
        static::$numeroAlerjProcesso = $faker->randomNumber();
        static::$tribunalProcesso = app(TribunaisRepository::class)
            ->randomElement()
            ->toArray();
        static::$varaProcesso = only_letters_and_space($faker->name);
        static::$dataDistribuicaoProcesso = $this->randomAcceptableDate();
        static::$acaoProcesso = app(AcoesRepository::class)
            ->randomElement()
            ->toArray();
        static::$juizProcesso = app(JuizesRepository::class)
            ->randomElement()
            ->toArray();
        static::$autorProcesso = only_letters_and_space($faker->name);
        static::$relatorProcesso = app(JuizesRepository::class)
            ->randomElement()
            ->toArray();
        static::$reuProcesso = only_letters_and_space($faker->name);
        static::$procuradorProcesso = $faker->randomElement(
            app(UsersRepository::class)
                ->getByType('Procurador')
                ->toArray()
        );
        static::$estagiarioProcesso = $faker->randomElement(
            app(UsersRepository::class)
                ->getByType('Estagiario')
                ->toArray()
        );
        static::$assessorProcesso = $faker->randomElement(
            app(UsersRepository::class)
                ->getByType('Assessor')
                ->toArray()
        );
        static::$tipoMeioProcesso = app(MeiosRepository::class)
            ->randomElement()
            ->toArray();
        static::$objetoProcesso = only_letters_and_space($faker->name);
        static::$ementaProcesso = only_letters_and_space($faker->name);
        static::$meritoProcesso = only_letters_and_space($faker->name);
        static::$liminarProcesso = only_letters_and_space($faker->name);
        static::$apensosObsProcesso = only_letters_and_space($faker->name);
        static::$recursoObsProcesso = only_letters_and_space($faker->name);
        static::$observacaoProcesso = only_letters_and_space($faker->name);
        static::$linkProcesso = only_letters_and_space($faker->name);
    }

    public function testInsert()
    {
        $this->init();

        $numeroJudicialP = static::$numeroJudicialProcesso;
        $numeroAlerjP = static::$numeroAlerjProcesso;
        $tribunalP = static::$tribunalProcesso;
        $varaP = static::$varaProcesso;
        $dataDistribuicaoP = static::$dataDistribuicaoProcesso;
        $acaoP = static::$acaoProcesso;
        $juizP = static::$juizProcesso;
        $autorP = static::$autorProcesso;
        $relatorP = static::$relatorProcesso;
        $reuP = static::$reuProcesso;
        $procuradorP = static::$procuradorProcesso;
        $estagiarioP = static::$estagiarioProcesso;
        $assessorP = static::$assessorProcesso;
        $tipoMeioP = static::$tipoMeioProcesso;
        $objetoP = static::$objetoProcesso;
        $ementaP = static::$ementaProcesso;
        $meritoP = static::$meritoProcesso;
        $liminarP = static::$liminarProcesso;
        $apensosObsP = static::$apensosObsProcesso;
        $recursoObsP = static::$recursoObsProcesso;
        $observacaoP = static::$observacaoProcesso;
        $linkP = static::$linkProcesso;

        $this->browse(function (Browser $browser) use (
            $numeroJudicialP,
            $numeroAlerjP,
            $tribunalP,
            $varaP,
            $dataDistribuicaoP,
            $acaoP,
            $juizP,
            $autorP,
            $relatorP,
            $reuP,
            $procuradorP,
            $estagiarioP,
            $assessorP,
            $tipoMeioP,
            $objetoP,
            $ementaP,
            $meritoP,
            $liminarP,
            $apensosObsP,
            $recursoObsP,
            $observacaoP,
            $linkP
        ) {
            $browser
                ->visit('/')
                ->clickLink('Novo')
                ->type('#numero_judicial', $numeroJudicialP)
                ->type('#numero_alerj', $numeroAlerjP)
                ->select('#tribunal_id', $tribunalP['id'])
                ->type('#vara', $varaP)
                ->keys('#data_distribuicao', $dataDistribuicaoP->format('d/m/Y'))
                ->screenshot('testeDataDist')
                ->select('#acao_id', $acaoP['id'])
                ->select('#juiz_id', $juizP['id'])
                ->type('#autor', $autorP)
                ->select('#relator_id', $relatorP['id'])
                ->type('#reu', $reuP)
                ->select('#procurador_id', $procuradorP['id'])
                ->select('#estagiario_id', $estagiarioP['id'])
                ->select('#assessor_id', $assessorP['id'])
                ->select('#tipo_meio', $tipoMeioP['id'])
                ->type('#objeto', $objetoP)
                ->type('#ementa', $ementaP)
                ->type('#merito', $meritoP)
                ->type('#liminar', $liminarP)
                ->type('#apensos_obs', $apensosObsP)
                ->type('#recurso', $recursoObsP)
                ->type('#observacao', $observacaoP)
                ->type('#link', $linkP)
                ->press('Gravar')
                ->waitForText('Gravado com sucesso', 40)
                ->waitForText($numeroJudicialP)
                ->assertSee($numeroJudicialP)
                ->assertSee($numeroAlerjP)
                ->assertSee($tribunalP['abreviacao'])
                ->assertSee($autorP)
                ->assertSee($objetoP)
                ->assertSee($procuradorP['name'])
                ->assertSee($assessorP['name'])
                ->assertSee($estagiarioP['name']);
        });
    }

    public function testWrongSearch()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/')
                ->type('pesquisa', '132312312vcxvdsf413543445654')
                ->click('@submit-search')
                ->waitForText('0 Processos')
                ->screenshot('wrongsearch')
                ->assertSee('0 Processos');
        });
    }

    public function testRightSearch()
    {
        $numeroJudicialP = static::$numeroJudicialProcesso;
        $numeroAlerjP = static::$numeroAlerjProcesso;
        $tribunalP = static::$tribunalProcesso;
        $varaP = static::$varaProcesso;
        $dataDistribuicaoP = static::$dataDistribuicaoProcesso;
        $acaoP = static::$acaoProcesso;
        $juizP = static::$juizProcesso;
        $autorP = static::$autorProcesso;
        $relatorP = static::$relatorProcesso;
        $reuP = static::$reuProcesso;
        $procuradorP = static::$procuradorProcesso;
        $estagiarioP = static::$estagiarioProcesso;
        $assessorP = static::$assessorProcesso;
        $tipoMeioP = static::$tipoMeioProcesso;
        $objetoP = static::$objetoProcesso;
        $ementaP = static::$ementaProcesso;
        $meritoP = static::$meritoProcesso;
        $liminarP = static::$liminarProcesso;
        $apensosObsP = static::$apensosObsProcesso;
        $recursoObsP = static::$recursoObsProcesso;
        $observacaoP = static::$observacaoProcesso;
        $linkP = static::$linkProcesso;

        $this->browse(function (Browser $browser) use (
            $numeroJudicialP,
            $numeroAlerjP,
            $tribunalP,
            $varaP,
            $dataDistribuicaoP,
            $acaoP,
            $juizP,
            $autorP,
            $relatorP,
            $reuP,
            $procuradorP,
            $estagiarioP,
            $assessorP,
            $tipoMeioP,
            $objetoP,
            $ementaP,
            $meritoP,
            $liminarP,
            $apensosObsP,
            $recursoObsP,
            $observacaoP,
            $linkP
        ) {
            $browser
                ->visit('/')
                ->maximize()
                ->type('pesquisa', $numeroJudicialP)
                ->click('@submit-search')
                ->waitForText($numeroAlerjP)
                ->assertSee($numeroAlerjP);
        });
    }

    public function testValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/')
                ->maximize()
                ->clickLink('Novo')
                ->select('#tipo_meio', '')
                ->press('Gravar')
                ->assertSee('O campo Número judicial é obrigatório.')
                ->assertSee('O campo Autor é obrigatório.')
                ->assertSee('O campo Réu é obrigatório.')
                ->assertSee('O campo Meio é obrigatório.');
        });
    }

    public function testAlterProcess()
    {
        $faker = app(Faker::class);
        $ProcessoP = app(ProcessosRepository::class)
            ->randomElement()
            ->toArray();
        $novoNumeroJudicialP = $faker->randomNumber();

        $novoDataDistribuicaoP = $this->randomAcceptableDate();
        $novoTribunalP = app(TribunaisRepository::class)
            ->randomElement()
            ->toArray();
        $novoAutorP = only_letters_and_space($faker->name);
        $novoObjetoP = only_letters_and_space($faker->name);
        $novaEmentaP = only_letters_and_space($faker->name);
        $novoProcuradorP = $faker->randomElement(
            app(UsersRepository::class)
                ->getByType('Procurador')
                ->toArray()
        );
        $novoAssessorP = $faker->randomElement(
            app(UsersRepository::class)
                ->getByType('Assessor')
                ->toArray()
        );
        $novoEstagiarioP = $faker->randomElement(
            app(UsersRepository::class)
                ->getByType('Estagiario')
                ->toArray()
        );

        $this->browse(function (Browser $browser) use (
            $ProcessoP,
            $novoNumeroJudicialP,
            $novoDataDistribuicaoP,
            $novoTribunalP,
            $novoAutorP,
            $novoObjetoP,
            $novaEmentaP,
            $novoProcuradorP,
            $novoAssessorP,
            $novoEstagiarioP
        ) {
            //  $browser = $this->loginPareceres($browser, false, Constants::SUBSYSTEM_PROCESSOS);
            $browser
                ->visit('/processos/' . $ProcessoP['id'])
                ->maximize()
                ->click('#editar')
                ->type('#numero_judicial', $novoNumeroJudicialP)
                ->select('#tribunal_id', $novoTribunalP['id'])
                ->keys('#data_distribuicao', $novoDataDistribuicaoP->format('d/m/Y'))
                ->type('#autor', $novoAutorP)
                ->select('#procurador_id', $novoProcuradorP['id'])
                ->select('#estagiario_id', $novoEstagiarioP['id'])
                ->select('#assessor_id', $novoAssessorP['id'])
                ->type('#ementa', $novaEmentaP)
                ->type('#objeto', $novoObjetoP)
                ->screenshot('tela_processo')
                ->press('Gravar');
            $browser
                ->assertSee('Gravado com sucesso', 30)
                ->waitForText($novoNumeroJudicialP)
                ->assertSee($novoNumeroJudicialP)
                ->assertSee($novoNumeroJudicialP)
                ->assertSee($novoTribunalP['abreviacao'])
                ->assertSee($novoAutorP)
                ->assertSee($novoObjetoP)
                ->assertSee($novoProcuradorP['name'])
                ->assertSee($novoAssessorP['name'])
                ->assertSee($novoEstagiarioP['name']);
        });
    }
}
