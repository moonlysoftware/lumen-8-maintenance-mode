<?php

namespace usmanjMoonlySoftwaredn93\MaintenanceMode\Testing;

use MoonlySoftware\MaintenanceMode\Console\Commands\DownCommand;
use MoonlySoftware\MaintenanceMode\Console\Commands\UpCommand;
use MoonlySoftware\MaintenanceMode\MaintenanceModeService;
use MoonlySoftware\MaintenanceMode\Providers\MaintenanceModeServiceProvider;

class ServiceProviderTest extends AbstractTestCase
{
    public function setUp() :void
    {
        parent::setUp();

        $this->app->register(MaintenanceModeServiceProvider::class);
    }

    /**
     * Testing dependence injection.
     */
    public function testShouldAddDependenciesToContainer()
    {
        $this->assertInstanceOf(
            MaintenanceModeService::class,
            $this->app['maintenance']
        );

        $this->assertInstanceOf(
            UpCommand::class,
            $this->app['command.up']
        );

        $this->assertInstanceOf(
            DownCommand::class,
            $this->app['command.down']
        );

        /* Asserting commands in Artisan */

        try {
            $this->assertEquals(0, $this->artisan('down'));

            $this->assertEquals(0, $this->artisan('up'));

            $this->artisan('invalid.command');
        } catch (\InvalidArgumentException $e) {
            $this->assertStringMatchesFormat('The command "invalid.command" does not exist.', $e->getMessage());
        }
    }
}
