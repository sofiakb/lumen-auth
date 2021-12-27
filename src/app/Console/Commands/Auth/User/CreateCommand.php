<?php
/**
 * lumen-auth
 * This file contains CreateCommand class.
 *
 * Created by PhpStorm on 27/12/2021 at 15:34
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Console\Commands\Auth\User
 * @file Sofiakb\Lumen\Auth\Console\Commands\Auth\User\CreateCommand
 */

namespace Sofiakb\Lumen\Auth\Console\Commands\Auth\User;

use Illuminate\Console\Command;
use Sofiakb\Lumen\Auth\Services\AuthService;
use Sofiakb\Lumen\Auth\Services\RegisterService;
use Sofiakb\Tools\Helpers;
use Symfony\Component\Console\Input\InputOption;

class CreateCommand extends Command
{
    
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'auth:user:create {--e|email= : Adresse email}';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create new user and save it into database.";
    
    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        $userClass = AuthService::userClass();
        
        $fillable = (new $userClass())->getFillable();
        $data = [];
        
        foreach ($fillable as $item) {
            if ($item !== 'password')
                $data[$item] = $this->hasOption($item) ? $this->option($item) : null;
        }
        
        $password = $this->secret("Mot de passe pour l'utilisateur");
        
        $data['password'] = $password;
        
        $data = collect($data)->filter(fn($item) => $item !== null)->toArray();
        $data = Helpers::toObject($data);
        
        $service = new RegisterService;
        if ($service->store($data))
            $this->info("~~ $data->email ~~\nUser created successfully.");
        else
            $this->error("~~ $data->email ~~\nAn error occured while creating account.");
        
    }
    
    protected function getOptions()
    {
        return array(
            array('email', null, InputOption::VALUE_REQUIRED, 'Adresse e-mail du compte à créer.'),
        );
    }
    
    
}