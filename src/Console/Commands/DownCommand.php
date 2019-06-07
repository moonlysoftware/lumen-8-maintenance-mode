<?php

namespace j3rrey\MaintenanceMode\Console\Commands;

class DownCommand extends MaintenanceCommand
{
    /**
     * @var string
     */
    protected $name = 'down';

    /**
     * @var string
     */
    protected $description = 'Put the application into maintenance mode.';

    /**
     * Put the application into maintenance mode.
     */
    public function handle()
    {
        if ($this->maintenance->isUpMode()) {
            $this->setDownMode();
        } else {
            $this->info('The application is already in maintenance mode!');
        }
    }
}
