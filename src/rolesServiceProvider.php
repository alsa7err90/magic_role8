<?php

namespace alsa7err90\magic_role8;

use alsa7err90\magic_role8\MagicRole;
use App\Models\Magpermission;
use App\Models\Magrole;
use App\Models\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class rolesServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('ViewRoles',function(){
            return new ViewRoles();
        });
    }

    public function boot()
    {
        $this->app['router']->aliasMiddleware('mag_roles', VerifyRole::class);
        $this->app['router']->aliasMiddleware('mag_permissions', VerifyPermission::class);
        $this->app['router']->aliasMiddleware('mag_users', VerifyLevel::class);
          $this->loadRoutesFrom(__DIR__.'/routes/web.php');
          $this->loadMigrationsFrom(__DIR__.'/db');
          $this->loadViewsFrom(__DIR__.'/view', 'mag');

          if(!file_exists('app/Http/Controllers/MagPermissionController.php') || !file_exists('app/Models/MagRoleController.php') || !file_exists('app/Models/MagUserController.php') ){
            $this->publishes([
                __DIR__.'/controller' => base_path('app/Http/Controllers'),
            ], 'mag_role');
        }

    if(!file_exists('app/Models/Magpermission.php') || !file_exists('app/Models/magrole.php')){
        $this->publishes([
            __DIR__.'/Models' => base_path('app/Models'),
        ], 'mag_role');
    }

    Blade::directive('mag_permission', function ()
    {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagPermissionController','show') ;
        $Magpermissions = Magpermission::get();
        return view('mag::mag_permission',compact('Magpermissions'));
       });

    Blade::directive('mag_user', function () {

        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagUserController','show') ;
        $magUsers =  User::with('roles')->get();
        $magRoles =  Magrole::get();
      return view('mag::mag_user',compact('magUsers','magRoles'));
    });

    Blade::directive('mag_role', function () {
        $magic_role = new MagicRole();
        $magic_role->chakeRole('MagUserController','show') ;
        $roles = Magrole::get();
      return view('mag::mag_role',compact('roles'));
    });

}
}
