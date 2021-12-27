<?php
/**
 * lumen-auth
 * This file contains AuthServiceProvider class.
 *
 * Created by PhpStorm on 27/12/2021 at 15:59
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Providers
 * @file Sofiakb\Lumen\Auth\Providers\AuthServiceProvider
 */

namespace Sofiakb\Lumen\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use Sofiakb\Lumen\Auth\Console\Commands\Auth\ActivateCommand as AuthActivateCommand;
use Sofiakb\Lumen\Auth\Console\Commands\Auth\ConfigCommand as AuthConfigCommand;
use Sofiakb\Lumen\Auth\Console\Commands\Auth\DeactivateCommand as AuthDeactivateCommand;
use Sofiakb\Lumen\Auth\Console\Commands\Auth\TableCommand as AuthTableCommand;
use Sofiakb\Lumen\Auth\Console\Commands\Auth\User\CreateCommand as AuthUserCreateCommand;
use Tymon\JWTAuth\Providers\LumenServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    
    /**
     *
     *
     */
    public function boot()
    {
        config(['logging.channels.auth' => [
            'driver' => 'daily',
            'path'   => env('LOG_PATH', storage_path('logs/auth')) . 'auth.log',
            'level'  => 'debug',
        ]]);
    }
    
    /**
     * Register Service Provider.
     *
     */
    public function register()
    {
        $this->app->register(LumenServiceProvider::class);
        
        $commands = [
            'command.auth.config'      => new AuthConfigCommand(),
            'command.auth.table'       => new AuthTableCommand(),
            'command.auth.activate'    => new AuthActivateCommand(),
            'command.auth.deactivate'  => new AuthDeactivateCommand(),
            'command.auth.user.create' => new AuthUserCreateCommand(),
        ];
        
        foreach ($commands as $command => $singleton) {
            $this->app->singleton(
                $command,
                function ($app) use ($singleton) {
                    return $singleton;
                }
            );
        }
        
        $this->commands(array_keys($commands));
    }
    
}