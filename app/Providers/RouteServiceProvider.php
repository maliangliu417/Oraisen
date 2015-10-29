<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use Auth;
use Session;

use App\Models\Users;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);

        $router->filter('auth', function()
        {
            if (Auth::guest())
                return redirect('/');
        });

        $router->filter('marketer', function()
        {
            if (Auth::user()->usrPermission != 'Marketer'){
                Session::flash('permission_status', 'You are not Marketer! Marketer only enter the invoice!');
                return redirect('dashboard');
            }
        });

        $router->filter('provider', function()
        {
            if (Auth::user()->usrPermission != 'Provider')
                return redirect('dashboard');
        });

        $router->filter('admin', function()
        {
            if (Session::get('admin_status') != 'true')
                return redirect('admin/login');
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
