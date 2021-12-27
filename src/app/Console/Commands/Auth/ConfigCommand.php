<?php
/**
 * lumen-auth
 * This file contains ConfigCommand class.
 *
 * Created by PhpStorm on 27/12/2021 at 15:18
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Console\Commands\Auth
 * @file Sofiakb\Lumen\Auth\Console\Commands\Auth\ConfigCommand
 */

namespace Sofiakb\Lumen\Auth\Console\Commands\Auth;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ConfigCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'auth:config';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Copy auth config file";
    
    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        $source = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'auth.php';
        $configPath = app()->configPath();
        
        File::ensureDirectoryExists($configPath);
        
        if (File::copy($source, $configPath . DIRECTORY_SEPARATOR . 'auth.php'))
            $this->info('Configuration file copied successfully');
    }
    
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return array(//            array('name', null, InputOption::VALUE_REQUIRED, 'Ajouter une clé existante'),
        );
    }
}