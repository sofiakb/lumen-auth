<?php
/**
 * lumen-auth
 * This file contains LoginController class.
 *
 * Created by PhpStorm on 27/12/2021 at 15:46
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Http\Controllers
 * @file Sofiakb\Lumen\Auth\Http\Controllers\LoginController
 */

namespace Sofiakb\Lumen\Auth\Http\Controllers;

use Sofiakb\Lumen\Auth\Services\LoginService;
use Sofiakb\Tools\Helpers;
use Sofiakb\Tools\Log\Log;
use Sofiakb\Tools\Response;
use Sofiakb\Tools\Result\Error;

/**
 * Class LoginController
 * @package Sofiakb\Lumen\Auth\Http\Controllers
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class LoginController extends Controller
{
    /**
     * @var LoginService
     */
    protected LoginService $service;
    
    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->service = new LoginService;
    }
    
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    /**
     * @return string
     */
    public function login()
    {
        if (($data = Helpers::body()) === null || !$this->service->validate($data, ['email', 'password']))
            return Response::error(400);
        
        Log::info("Connexion de " . $data->email);
        if (($token = $this->service->login($data->email, $data->password, $data->remember ?? false)) === null)
            return Response::error(401);
        
        Log::info("Vérification d'un erreur potentielle");
        if (Error::is($token))
            return Response::unknown($token);
        
        Log::info($data->email . " est connecté");
        
        return Response::success([
            'user'  => auth()->user(),
            'token' => [
                'content' => $token,
                'expires' => $this->service->getTTL($data->remember ?? false)
            ]
        ]);
    }
}