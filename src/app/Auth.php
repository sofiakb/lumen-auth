<?php
/**
 * lumen-auth
 * This file contains Auth class.
 *
 * Created by PhpStorm on 27/12/2021 at 12:29
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 */

namespace Sofiakb\Lumen\Auth;


/**
 * Class Auth
 * @package Sofiakb\Lumen\Auth
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class Auth
{
    /**
     * Get auth routes.
     *
     * @return string
     */
    public static function routes(): string
    {
        return require __DIR__ . '/../routes/auth.php';
    }
}