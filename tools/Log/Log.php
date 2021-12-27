<?php
/**
 * This file contains Log class.
 *
 * Created by PhpStorm on 27/12/2021 at 14:23
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Tools\Log
 * @file Sofiakb\Tools\Log\Log
 */

namespace Sofiakb\Tools\Log;

use Illuminate\Support\Facades\Log as Logging;

/**
 * Class Log
 * @package Ssf\Lumen\Auth\Tools\Log
 * @author Sofiane Akbly <sofiane.akbly@gmail.com>
 *
 * @mixin Logging
 */
class Log
{
    
    /**
     * @param string $type
     * @param $message
     * @param string $channel
     */
    public static function write(string $type, $message, string $channel = 'auth')
    {
        Logging::channel($channel)->$type($message);
    }
    
    public static function __callStatic($name, $arguments)
    {
        self::write(...array_merge([$name], $arguments));
    }
}