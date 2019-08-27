<?php

namespace Tests\Browser;

use App\Data\Repositories\Users as UsersRepository;
use Faker\Generator as Faker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersTest extends DuskTestCase
{
    private static $personalEmailUsers;
    private static $randomUserUsers;
    private static $NameUsers;

    public function init()
    {
        $faker = app(Faker::class);
        static::$personalEmailUsers = $faker->email;
        static::$NameUsers = only_letters_and_space($faker->name);

        do {
            static::$randomUserUsers = app(
                UsersRepository::class
            )->randomElement();
        } while (static::$randomUserUsers->userType->nome == 'Administrador');
    }

    public function testValidation()
    {
        $this->init();

        $randomUserU = static::$randomUserUsers;
        $NameU = static::$NameUsers;

        $this->browse(function (Browser $browser) use ($randomUserU, $NameU) {
            $browser
                ->visit('/users/' . $randomUserU['id'])
                ->click('#editar')
                ->type('#personal_email', $NameU)
                ->press('Gravar')
                ->assertSee(
                    'O campo Email pessoal não contém um endereço de email válido.'
                );
        });
    }

    public function testAlter()
    {
        $personalEmailU = static::$personalEmailUsers;
        $randomUserU = static::$randomUserUsers;

        $this->browse(function (Browser $browser) use (
            $personalEmailU,
            $randomUserU
        ) {
            $browser
                ->visit('/users/' . $randomUserU['id'])
                ->click('#editar')
                ->type('#personal_email', $personalEmailU)
                ->press('Gravar')
                ->assertSee('Gravado com sucesso');
        });
    }

    public function testRoute()
    {
        $personalEmailU = static::$personalEmailUsers;
        $randomUserU = static::$randomUserUsers;

        $this->browse(function (Browser $browser) use (
            $personalEmailU,
            $randomUserU
        ) {
            $browser
                ->visit('/users')
                ->waitForText($randomUserU['name'])
                ->clickLink($randomUserU['name'])
                ->assertPathIs('/users/' . $randomUserU['id'])
                ->assertSee($randomUserU['email']);
        });
    }
}
