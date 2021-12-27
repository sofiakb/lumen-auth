<?php
/**
 * lumen-auth
 * This file contains ActivateCommand class.
 *
 * Created by PhpStorm on 27/12/2021 at 14:29
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Console\Commands\Auth
 * @file Sofiakb\Lumen\Auth\Console\Commands\Auth\ActivateCommand
 */

namespace Sofiakb\Lumen\Auth\Console\Commands\Auth;

use Illuminate\Console\Command;
use Sofiakb\Lumen\Auth\Services\AuthService;
use Symfony\Component\Console\Input\InputOption;

class ActivateCommand extends Command
{
    
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'auth:activate {--u|user= : Nom d\'utilisateur ou adresse e-mail du compte à activer.}';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Activate auth account by username/email";
    
    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        $userClass = AuthService::userClass();
        
        $service = new AuthService();
        
        if (($login = $this->option('user') === null))
            throw new \Exception("Le nom d'utilisateur ou l'adresse e-mail est obligatoire");
        
        if (($entry = $service->loadUserByUsername($login)) === null && ($entry = $service->loadUserByEmail($login)) === null)
            throw new \Exception("Aucun utilisateur n'existe pour $login");
        
        if (method_exists($userClass, 'activate')) {
            if ($entry->activate())
                $this->info("~~ $login ~~\nAuth account activated successfully.");
        } else $this->error("Method [activate] not found in class $userClass");
    }
    
    
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return array(
            array('user', null, InputOption::VALUE_REQUIRED, "Nom d'utilisateur ou adresse e-mail du compte à activer"),
        );
    }
    
}