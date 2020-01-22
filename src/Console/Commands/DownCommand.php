<?php

namespace faizalmansor\MaintenanceMode\Console\Commands;

use Illuminate\Support\Facades\App;

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
        $viewPath = App::resourcePath('views/errors/503.blade.php');
        if( !$this->viewExists($viewPath) ){
            if($this->ask('Maintenance view does not exists, should I create one ?')){
                $this->createMaintenanceView($viewPath);
            };
        }

        if ($this->maintenance->isUpMode()) {
            $this->setDownMode();
        } else {
            $this->info('The application is already in maintenance mode!');
        }
    }

    /**
     * @param string $filePath
     * @return bool
     */
    public function viewExists(string $filePath): bool
    {
        if(!file_exists($filePath)){
            return false;
        }

        return true;
    }

    /**
     * @param string $filePath
     * @return bool | int
     */
    private function createMaintenanceView(string $filePath) : bool
    {
        touch($filePath);
        return file_put_contents(
            $filePath,
            file_get_contents(
                __DIR__ . '../../../view/503.blade.php'
            )
        );
    }
}
