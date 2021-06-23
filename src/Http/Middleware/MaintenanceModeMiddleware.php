<?php

namespace usmanjdn93\MaintenanceMode\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;
use usmanjdn93\MaintenanceMode\MaintenanceModeService;

class MaintenanceModeMiddleware
{
    /**
     * Maintenance Mode Service.
     *
     * @var \usmanjdn93\MaintenanceMode\MaintenanceModeService
     */
    protected $maintenance;

    /**
     * MaintenanceModeMiddleware constructor.
     * @param MaintenanceModeService $maintenance
     */
    public function __construct(MaintenanceModeService $maintenance)
    {
        $this->maintenance = $maintenance;
    }

    /**
     * Handle incoming requests.
     *
     * @param Request $request
     * @param \Closure $next
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     * @throws \InvalidArgumentException
     */
    public function handle($request, Closure $next)
    {
        if ($this->maintenance->isDownMode() && !$this->maintenance->checkAllowedIp($this->getIp())) {
            if (View::exists('errors.503')) {
                return view('errors.503');
            }
            return response()->json([
                'error' => [
                    'message' => 'The application is down for maintenance.'
                ]
            ], 503);
        }

        return $next($request);
    }

    /**
     * Get client ip
     */
    private function getIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}
