<?php
/**
 * This file contains Result class.
 *
 * Created by PhpStorm on 27/12/2021 at 14:04
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Tools\Result
 * @file Sofiakb\Tools\Result\Result
 */

namespace Sofiakb\Tools\Result;

class Result
{
    /**
     * @param mixed|null $message
     * @return Error|Success
     */
    public static function unauthorized($message = null)
    {
        return self::toArray(401, $message ?? "Vous devez être connecté pour accéder aux informations");
    }
    
    /**
     * @param mixed|null $message
     * @return Error|Success
     */
    public static function forbidden($message = null)
    {
        return self::toArray(403, $message ?? "Vous n'avez pas les droits pour effecuter cette opération");
    }
    
    /**
     * @param mixed|null $message
     * @return Error|Success
     */
    public static function badRequest($message = null)
    {
        return self::toArray(400, $message ?? "Merci de bien vouloir remplir les informations");
    }
    
    /**
     * @param mixed|null $message
     * @return Error|Success
     */
    public static function notFound($message = null)
    {
        return self::toArray(404, $message ?? "La page demandée n'existe pas");
    }
    
    /**
     * @param mixed|null $message
     * @param int $code
     * @return Error|Success
     */
    public static function error($message = null, int $code = 500)
    {
        return Result::toArray($code, $message);
    }
    
    /**
     * @param mixed|null $message
     * @param int $code
     * @return Error|Success
     */
    public static function duplicate($message = null, int $code = 419)
    {
        return self::toArray($code, $message ?? "Une ressource existe déjà avec cette valeur");
    }
    
    /**
     * @param $code
     * @param mixed|null $message
     * @param bool $error
     * @return Error|Success
     */
    public static function toArray($code, $message = null, bool $error = true)
    {
        return $error ? new Error($code, $message) : new Success($code, $message);
    }
    
    /**
     * @param string $message
     * @param int $code
     * @return Error|Success
     */
    public static function success($message = 'OK', $code = 200)
    {
        return self::toArray($code, $message, false);
    }
    
}