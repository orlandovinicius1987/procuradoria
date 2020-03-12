<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\TestCase as BaseTestCase;
use Faker\Generator as Faker;
use App\Data\Models\TipoUsuario;
use Laravel\Dusk\Browser;
use App\Data\Models\User;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    public function loginPareceres(
        Browser $browser,
        $isEstagiarioCheck,
        $selectedSubsystem
    ) {
        $faker = app(Faker::class);
        $user = $faker->randomElement(
            User::where(
                'user_type_id',
                TipoUsuario::where(
                    'nome',
                    $isEstagiarioCheck ? '=' : '!=',
                    'Estagiario'
                )->first()->id
            )
                ->get()
                ->toArray()
        );

        $browser
            ->loginAs($user['id'])
            ->visit('/subsystem')
            ->clickLink($selectedSubsystem);

        return $browser;
    }

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     *
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions())->addArguments([
            '--disable-gpu',
            '--headless',
            '--window-size=1920,1080',
            '--disable-web-security',
            '--lang=bg'
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY,
                $options
            )
        );
    }
}
