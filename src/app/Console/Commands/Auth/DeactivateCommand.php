<?php
/**
 * lumen-auth
 * This file contains DeactivateCommand class.
 *
 * Created by PhpStorm on 27/12/2021 at 14:34
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Console\Commands\Auth
 * @file Sofiakb\Lumen\Auth\Console\Commands\Auth\DeactivateCommand
 */

namespace Sofiakb\Lumen\Auth\Console\Commands\Auth;

use Illuminate\Console\Command;
use Sofiakb\Lumen\Auth\Services\AuthService;
use Symfony\Component\Console\Input\InputOption;

class DeactivateCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'auth:deactivate {--u|user= : Nom d\'utilisateur ou adresse e-mail du compte à désactiver.}';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Deactivate auth account by username/email";
    
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
    
        if (method_exists($userClass, 'deactivate')) {
            if ($entry->deactivate())
                $this->info("~~ $login ~~\nAuth account deactivated successfully.");
        } else $this->error("Method [deactivate] not found in class $userClass");
    }
    
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('user', null, InputOption::VALUE_REQUIRED, "Nom d'utilisateur ou adresse e-mail du compte à désactiver"),
        );
    }
}