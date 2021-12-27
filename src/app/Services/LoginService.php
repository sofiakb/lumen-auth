<?php
/**
 * lumen-auth
 * This file contains LoginService class.
 *
 * Created by PhpStorm on 27/12/2021 at 14:18
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Services
 * @file Sofiakb\Lumen\Auth\Services\LoginService
 */

namespace Sofiakb\Lumen\Auth\Services;

use Illuminate\Support\Carbon;
use Sofiakb\Tools\Log\Log;
use Sofiakb\Tools\Result\Error;
use Sofiakb\Tools\Result\Success;

class LoginService extends AuthService
{
    
    /**
     * @param string $email
     * @param string $password
     * @param bool $remember
     * @return Error|Success|null|string
     */
    public function login(?string $email, ?string $password, string $app, bool $remember = false)
    {
        if ($email === null || $password === null)
            return null;
        
        if (($user = $this->loadUserByEmail($email)) === null) {
            if (($user = $this->loadUserByUsername($email)) === null)
                return $this->notExists();
            else $field = 'username';
        } else $field = 'email';
        
        if (!auth()->validate([$field => $email, "password" => $password]))
            return $this->wrongPassword();
        
        $token = $this->generateToken($user, $password, $app, $remember);
        $expires = Carbon::now()->unix() + $this->getTTL($remember);
        
        parent::connectionClass()::updateOrCreate([
            'user_id' => $user->id,
        ], [
            'latest'    => Carbon::now(),
            'logout_at' => null,
            'expires'   => $expires,
            'data'      => collect([
                'token' => [
                    'content' => $token,
                    'expires' => $expires,
                ],
            ])->toArray()
        ]);
        Log::info("Token généré pour {$user->email}");
        return $token;
        
    }
    
}