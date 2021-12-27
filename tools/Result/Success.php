<?php
/**
 * This file contains Success class.
 *
 * Created by PhpStorm on 27/12/2021 at 13:58
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Tools\Result
 * @file Sofiakb\Lumen\Auth\Tools\Result\Success
 */

namespace Sofiakb\Tools\Result;

/**
 * Class Success
 * @package Sofiakb\Utils\Result
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class Success
{
    /**
     * @var mixed $code
     */
    public $code;
    /**
     * @var mixed $message
     */
    public $message;
    
    /**
     * Success constructor.
     * @param mixed $code
     * @param mixed $message
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