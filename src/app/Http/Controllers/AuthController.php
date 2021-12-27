<?php
/**
 * lumen-auth
 * This file contains AuthController class.
 *
 * Created by PhpStorm on 27/12/2021 at 15:41
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Http\Controllers
 * @file Sofiakb\Lumen\Auth\Http\Controllers\AuthController
 */

namespace Sofiakb\Lumen\Auth\Http\Controllers;

use Sofiakb\Lumen\Auth\Services\AuthService;
use Sofiakb\Tools\Response;
use stdClass;

/**
 * Class AuthController
 * @package Sofiakb\Lumen\Auth\Http\Controllers
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class AuthController extends Controller
{
    /**
     * @var stdClass
     */
    protected stdClass $classes;
    
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->classes = (new AuthService)->getClasses();
    }
    
    /**
     * Retrieve current user.
     *
     * @return string
     */
    public function user()
    {
        return ($user = AuthService::user()) instanceof $this->classes->user
            ? Response::success(['user' => $user])
            : Response::unknown($user);
    }
    
    /**
     * Logout user.
     *
     * @return string
     */
    public function logout()
    {
        return Response::success(AuthService::logout());
    }
    
    /**
     * Know if user is logged.
     *
     * @return string
     */
    public function logged()
    {
        return Response::success(['logged' => AuthService::logged()]);
    }
}