<?php
namespace Colin\Log;

use Illuminate\Support\ServiceProvider;

class LogSplitServiceProvider extends ServiceProvider {

     /**
     * @var array
     */
    protected $commands = [
        Console\InstallCommand::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'log.session'    => Middleware\Session::class,
    ];

        /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'log' => [
        'log.auth',
        'log.pjax',
        'log.log',
        'log.bootstrap',
        'log.permission',
        //            'log.session',
        ],
    ];

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'log');

        $this->ensureHttps();

        if (file_exists($routes = admin_path('routes.php'))) {
            $this->loadRoutesFrom($routes);
        }

        $this->registerPublishing();
    }

    /**
     * Force to set https scheme if https enabled.
     *
     * @return void
     */
    protected function ensureHttps()
    {
        if (config('admin.https') || config('admin.secure')) {
            url()->forceScheme('https');
            $this->app['request']->server->set('HTTPS', true);
        }
    }

        /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config' => config_path()], 'laravel-admin-config');
            $this->publishes([__DIR__.'/../resources/lang' => resource_path('lang')], 'laravel-admin-lang');
            $this->publishes([__DIR__.'/../database/migrations' => database_path('migrations')], 'laravel-admin-migrations');
            $this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/laravel-admin')], 'laravel-admin-assets');
        }
    }

    // 註冊套件函式
    public function register()
    {
        $this->app->singleton('logsplit', function ($app) {
            return new LogSplit();
        });
    }
}
