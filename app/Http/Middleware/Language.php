<?php
namespace App\Http\Middleware;

use App\SettingsUser;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;

class Language
{
    private $lang = "";

    public function __construct(Application $app, Request $request, SettingsUser $userSettings)
    {
        $this->app = $app;
        $this->request = $request;

        $this->lang = $userSettings->get('lang_id');
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->app->setLocale($this->lang, config('app.locale'));

        return $next($request);
    }
}
