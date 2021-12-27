<?php
/**
 * This file contains Helpers class.
 *
 * Created by PhpStorm on 27/12/2021 at 14:15
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Tools
 * @file Sofiakb\Tools\Helpers
 */

namespace Sofiakb\Tools;

class Helpers
{
    
    /**
     * Convert array to object.
     *
     * @param $array
     * @return mixed
     */
    public static function toObject($array)
    {
        return json_decode(json_encode($array));
    }
    
    /**
     * Convert array to object.
     *
     * @param $object
     * @return mixed
     */
    public static function toArray($object)
    {
        return json_decode(json_encode($object), true);
    }
    
    /**
     * Retrieve request body.
     *
     * @param string $param
     * @return mixed
     */
    public static function body(string $param = 'data')
    {
        return self::toObject($param ? request()->get($param) : request());
    }
    
    /**
     * Crypt password for save database.
     *
     * @param $value
     * @param array $options
     * @return mixed
     */
    public static function bcrypt($value, array $options = [])
    {
        return app('hash')->make($value, $options);
    }
    
}