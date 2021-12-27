<?php
/**
 * This file contains Error class.
 *
 * Created by PhpStorm on 27/12/2021 at 13:57
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Tools\Result
 * @file Sofiakb\Lumen\Auth\Tools\Result\Error
 */

namespace Sofiakb\Tools\Result;

/**
 * Class Error
 * @package Sofiakb\Lumen\Auth\Tools\Result
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class Error
{
    /**
     * @var
     */
    public $code;
    
    /**
     * @var
     */
    public $message;
    
    /**
     * @param $code
     * @param $message
     */
    public function __construct($code, $message)
    {
        $this->code = $code;
        $this->message = $message;
    }
    
    /**
     * @param $mixed
     * @return bool
     */
    public static function is($mixed): bool
    {
        return $mixed instanceof self;
    }
}
