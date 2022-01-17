<?php
/**
 * lumen-auth
 * This file contains TableCommand class.
 *
 * Created by PhpStorm on 27/12/2021 at 15:27
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Console\Commands\Auth
 * @file Sofiakb\Lumen\Auth\Console\Commands\Auth\TableCommand
 */

namespace Sofiakb\Lumen\Auth\Console\Commands\Auth;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class TableCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'auth:table';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create migration for users table";
    
    /**
     * Execute the console command.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        
        $tables = [
            'users',
            'connections'
        ];
        
        foreach ($tables as $table)
            $this->copy($table);
    }
    
    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(//            array('name', null, InputOption::VALUE_REQUIRED, 'Ajouter une clé existante'),
        );
    }
    
    private function copy(string $table)
    {
        $this->warn("Creating [$table] migration file.");
        $source = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations';
        
        $target = database_path('migrations');
        
        File::ensureDirectoryExists(database_path('migrations'));
        
        $filename = 'create_' . $table . '_table.php';
        if (File::copy($source . DIRECTORY_SEPARATOR . $filename, $target . DIRECTORY_SEPARATOR . Carbon::now()->format('Y_m_d_His') . "_" . $filename))
            $this->info("Table migration created successfully [$filename].");
        else
            $this->error("Error while creating [$filename] table migration.");
        
    }
}