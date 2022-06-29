<?php
/**
 * lumen-auth
 * This file contains RegisterController class.
 *
 * Created by PhpStorm on 27/12/2021 at 15:48
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Http\Controllers
 * @file Sofiakb\Lumen\Auth\Http\Controllers\RegisterController
 */

namespace Sofiakb\Lumen\Auth\Http\Controllers;

use Sofiakb\Lumen\Auth\Services\AuthService;
use Sofiakb\Lumen\Auth\Services\RegisterService;
use Sofiakb\Tools\Helpers;
use Sofiakb\Tools\Log\Log;
use Sofiakb\Tools\Response;

class RegisterController extends Controller
{
    /**
     * @var RegisterService
     */
    protected RegisterService $service;
    
    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->service = new RegisterService;
    }
    
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles registering users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    
    /**
     * @return string
     */
    public function register()
    {
        if (($data = Helpers::body()) === null || !$this->service->validate($data, ['email', 'password']))
            return Response::error(400);
        
        Log::info("Inscription de " . $data->email);
        if (($user = $this->service->register($data)) === null)
            return Response::error(400);
        
        Log::info("Vérification d'un erreur potentielle");
        $userClass = AuthService::userClass();
        if (!($user instanceof $userClass))
            return Response::unknown($user);
        
        Log::info($data->email . " a bien créé son compte");
        
        return Response::success($user);
    }
}