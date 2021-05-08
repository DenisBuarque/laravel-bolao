<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\App;
use App\User;
use App\Permission;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        $this->register();

        if(!App::runningInConsole()){ // se não estiver rodando pelo terminal console
            foreach($this->listPermissions() as $key => $value):
                Gate::define($value->name, function (User $user) use($value) {
                    
                    return $user->hasRoles($value->roles); // chama funcão do modelo User.php
                });
            endforeach;
        }
    }

    public function listPermissions()
    {
        // chama a função roles() do modelo Permission.php
        return Permission::with('roles')->get();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\UserRepositoryInterface','App\Repositories\Eloquent\UserRepository');
        $this->app->bind('App\Repositories\Contracts\PermissionRepositoryInterface','App\Repositories\Eloquent\PermissionRepository');
        $this->app->bind('App\Repositories\Contracts\RoleRepositoryInterface','App\Repositories\Eloquent\RoleRepository');
        $this->app->bind('App\Repositories\Contracts\BettingRepositoryInterface','App\Repositories\Eloquent\BettingRepository');
        $this->app->bind('App\Repositories\Contracts\RoundRepositoryInterface','App\Repositories\Eloquent\RoundRepository');
        $this->app->bind('App\Repositories\Contracts\MatchRepositoryInterface','App\Repositories\Eloquent\MatchRepository');
    }

   
}
