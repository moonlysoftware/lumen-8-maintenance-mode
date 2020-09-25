<?php

namespace usmanjdn93\MaintenanceMode\Testing;

use usmanjdn93\MaintenanceMode\Console\Commands\DownCommand;
use usmanjdn93\MaintenanceMode\Console\Commands\UpCommand;
use usmanjdn93\MaintenanceMode\MaintenanceModeService;
use usmanjdn93\MaintenanceMode\Providers\MaintenanceModeServiceProvider;

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
