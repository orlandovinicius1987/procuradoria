<?php

namespace Tests\Browser;

use App\Data\Repositories\Processos as ProcessosRepository;
use App\Data\Repositories\TiposAndamentos as TiposAndamentosRepository;
use App\Data\Repositories\TiposPrazos as TiposPrazosRepository;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AndamentosTest extends DuskTestCase
{
    private static $processoAndamento;
    private static $tipoAndamentoAndamento;
    private static $tipoPrazoAndamento;
    private static $dataPrazoAndamento;
    private static $dataEntregaAndamento;
    private static $observacaoAndamento;

    public function init()
    {
        $faker = app(Faker::class);
        static::$processoAndamento = app(ProcessosRepository::class)
            ->randomElement()
            ->toArray();
        do {
            static::$tipoAndamentoAndamento = app(
                TiposAndamentosRepository::class
            )
                ->randomElement()
                ->toArray();
        } while (static::$tipoAndamentoAndamento['nome'] == 'Recebimento');
        static::$tipoPrazoAndamento = app(TiposPrazosRepository::class)
            ->randomElement()
            ->toArray();
        static::$dataPrazoAndamento = '01-01-2001';
        static::$dataEntregaAndamento = '01-01-2001';
        static::$observacaoAndamento = only_letters_and_space($faker->name);
    }

    public function testInsert()
    {
        $this->init();

        $processoA = static::$processoAndamento;
        $tipoAndamentoA = static::$tipoAndamentoAndamento;
        $tipoPrazoA = static::$tipoPrazoAndamento;
        $dataPrazoA = static::$dataPrazoAndamento;
        $dataEntregaA = static::$dataEntregaAndamento;
        $observacaoA = static::$observacaoAndamento;

        $this->browse(function (Browser $browser) use (
            $processoA,
            $tipoAndamentoA,
            $tipoPrazoA,
            $dataPrazoA,
            $dataEntregaA,
            $observacaoA
        ) {
            $browser
                ->visit('/andamentos')
                ->clickLink('Novo')
                ->select('#processo_id', $processoA['id'])
                ->select('#tipo_andamento_id', $tipoAndamentoA['id'])
                ->select('#tipo_prazo_id', $tipoPrazoA['id'])
                ->keys('#data_prazo', $dataPrazoA)
                ->keys('#data_entrega', $dataEntregaA)
                ->type('#observacoes', $observacaoA)
                ->press('Gravar')
                ->assertSee('Gravado com sucesso')
                ->assertSee($observacaoA);
        });
    }

    public function testValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/andamentos')
                ->clickLink('Novo')
                ->press('Gravar')
                ->assertSee('O campo Processo é obrigatório.')
                ->assertSee('O campo Tipo de andamento é obrigatório.');
        });
    }

    public function testWrongSearch()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/andamentos')
                ->type(
                    'pesquisa',
                    '45879349875348975387958973489734897345893478957984'
                )
                ->click('#searchButton')
                ->waitForText('Nenhum andamento encontrado')
                ->assertSee('Nenhum andamento encontrado');
        });
    }

    public function testRightSearch()
    {
        $observacaoA = static::$observacaoAndamento;

        $this->browse(function (Browser $browser) use ($observacaoA) {
            $browser
                ->visit('/andamentos')
                ->type('pesquisa', $observacaoA)
                ->click('#searchButton')
                ->waitForText($observacaoA)
                ->assertSeeIn('#andamentosTable', $observacaoA);
        });
    }

    public function testAlter()
    {
        $faker = app(Faker::class);

        $processoA = app(ProcessosRepository::class)
            ->randomElement()
            ->toArray();
        $tipoAndamentoA = app(TiposAndamentosRepository::class)
            ->randomElement()
            ->toArray();
        $tipoPrazoA = app(TiposPrazosRepository::class)
            ->randomElement()
            ->toArray();
        $dataPrazoA = \DateTime::createFromFormat('m-d-Y', '03-02-2333');
        $dataEntregaA = \DateTime::createFromFormat('m-d-Y', '04-05-2444');
        $observacaoA = only_letters_and_space($faker->name);

        $numProcesso = static::$processoAndamento['numero_judicial'];

        $this->browse(function (Browser $browser) use (
            $processoA,
            $tipoAndamentoA,
            $tipoPrazoA,
            $dataPrazoA,
            $dataEntregaA,
            $observacaoA,
            $numProcesso
        ) {
            $browser
                ->visit('/andamentos')
                ->clickLink($numProcesso)
                ->click('#editar')
                ->select('#processo_id', $processoA['id'])
                ->select('#tipo_andamento_id', $tipoAndamentoA['id'])
                ->select('#tipo_prazo_id', $tipoPrazoA['id'])
                ->keys('#data_prazo', $dataPrazoA->format('d/m/Y'))
                ->keys('#data_entrega', $dataEntregaA->format('d/m/Y'))
                ->type('#observacoes', $observacaoA)
                ->press('Gravar')
                ->assertSee('Gravado com sucesso')
                ->assertSee($processoA['numero_judicial'])
                ->assertSee($tipoAndamentoA['nome'])
                ->assertSee($tipoPrazoA['nome'])
                ->assertSee($observacaoA);
        });
    }

    public function testInsertInsideProcesso()
    {
        $this->init();

        $processoA = static::$processoAndamento;
        $tipoAndamentoA = static::$tipoAndamentoAndamento;
        $tipoPrazoA = static::$tipoPrazoAndamento;
        $dataPrazoA = static::$dataPrazoAndamento;
        $dataEntregaA = static::$dataEntregaAndamento;
        $observacaoA = static::$observacaoAndamento;

        $this->browse(function (Browser $browser) use (
            $processoA,
            $tipoAndamentoA,
            $tipoPrazoA,
            $dataPrazoA,
            $dataEntregaA,
            $observacaoA
        ) {
            $browser
                ->visit('/processos/' . $processoA['id'])
                ->click('#editar')
                ->scrollTo('#buttonAndamentos');

            $browser
                ->click('#buttonAndamentos')
                ->select('#tipo_andamento_id', $tipoAndamentoA['id'])
                ->select('#tipo_prazo_id', $tipoPrazoA['id'])
                ->keys('#data_prazo', $dataPrazoA)
                ->keys('#data_entrega', $dataEntregaA)
                ->type('#observacoes', $observacaoA)
                ->press('Gravar')
                ->assertSee('Gravado com sucesso')
                ->assertSeeIn('#andamentosTable', $observacaoA);
        });
    }
}
