<?php

namespace j3rrey\MaintenanceMode;

use Laravel\Lumen\Application;

class MaintenanceModeService
{
    /**
     * File to verify maintenance mode.
     *
     * @var string
     */
    protected $maintenanceFile = 'framework/down';

    /**
     * Lumen Application instance.
     *
     * @var \Laravel\Lumen\Application
     */
    protected $app;

    /**
     * MaintenanceModeService constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Verify if application is in maintenance mode.
     *
     * @return bool
     */
    public function isDownMode()
    {
        return $this->maintenanceFileExists();
    }

    /**
     * Indicates if maintenance file exists.
     *
     * @return bool
     */
    public function maintenanceFileExists()
    {
        return file_exists($this->maintenanceFilePath());
    }

    /**
     * Maintenance file path.
     *
     * @return string
     */
    public function maintenanceFilePath()
    {
        return $this->app->storagePath($this->maintenanceFile);
    }

    /**
     * Verify if application is up.
     *
     * @return bool
     */
    public function isUpMode()
    {
        return !$this->maintenanceFileExists();
    }

    /**
     * Put the application in down mode.
     *
     * @throws Exceptions\FileException
     *
     * @return bool true if success and false if something fails.
     */
    public function setDownMode()
    {
        $viewPath = $this->app->resourcePath('/view/errors/503.blade.php');
        if( !$this->verifyViewExists($viewPath) ){
            $this->createMaintenanceView($viewPath);
        }

        $file = $this->maintenanceFilePath();

        if (!touch($file)) {
            $message = sprintf(
                'Something went wrong on trying to create maintenance file %s.',
                $file
            );

            throw new Exceptions\FileException($message);
        }

        return true;
    }

    /**
     * Put application in up mode.
     *
     * @throws Exceptions\FileException
     *
     * @return bool true if success and false if something fails.
     */
    public function setUpMode()
    {
        $file = $this->maintenanceFilePath();

        if (file_exists($file) && !unlink($file)) {
            $message = sprintf(
                'Something went wrong on trying to remove maintenance file %s.',
                $file
            );

            throw new Exceptions\FileException($message);
        }

        return true;
    }

    /**
     * @param string $ip
     * @return bool
     */
    public function checkAllowedIp(string $ip)
    {
        $allowed = explode(',', env('ALLOWED_IPS'));

        return in_array($ip, $allowed);
    }

    /**
     * @param string $filePath
     * @return bool
     */
    public function verifyViewExists(string $filePath): bool
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
                $this->app->basePath('/view/503.blade.php')
            )
        );
    }

}
