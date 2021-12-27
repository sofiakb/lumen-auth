<?php
/**
 * lumen-auth
 * This file contains AuthService class.
 *
 * Created by PhpStorm on 27/12/2021 at 13:54
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Services
 * @file Sofiakb\Lumen\Auth\Services\AuthService
 */

namespace Sofiakb\Lumen\Auth\Services;

use Illuminate\Support\Carbon;
use Sofiakb\Tools\Helpers;
use Sofiakb\Tools\Result\Error;
use Sofiakb\Tools\Result\Result;
use Sofiakb\Tools\Result\Success;
use stdClass;

/**
 * Class AuthService
 * @package Sofiakb\Lumen\Auth\Services
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class AuthService
{
    
    /**
     * @var AuthService|null
     */
    private static ?AuthService $instance = null;
    
    /**
     * @var stdClass
     */
    private stdClass $classes;
    
    /**
     * AuthService constructor.
     */
    public function __construct()
    {
        $this->classes = new stdClass();
        $this->classes->user = config('auth.providers.users.model');
        $this->classes->connection = config('auth.providers.connections.model');
    }
    
    /**
     * @return array|Error|Success
     */
    public static function user()
    {
        $class = self::userClass();
        if (!self::logged() || ($user = $class::whereId(auth()->id())->first()) === null)
            return Result::unauthorized();
        return new $class(collect($user)->merge(['expires' => Carbon::now()->addHour()->unix(), 'logged' => true])->toArray());
    }
    
    /**
     * @return bool
     */
    public static function logout(): bool
    {
        $class = self::connectionClass();
        if (self::logged())
            $class::updateOrCreate([
                'user_id' => auth()->id()
            ], [
                'logout_at' => Carbon::now()
            ]);
        
        auth()->logout();
        return true;
    }
    
    /**
     * @return bool
     */
    public static function logged(): bool
    {
        return !(auth()->user() === null);
    }
    
    /**
     * @return mixed
     */
    public static function userClass()
    {
        return self::getInstance()->getClasses()->user;
    }
    
    /**
     * @return mixed
     */
    public static function connectionClass()
    {
        return self::getInstance()->getClasses()->connection;
    }
    
    /**
     * @return static
     */
    public static function getInstance(): ?self
    {
        if (is_null(self::$instance))
            self::$instance = new static;
        return self::$instance;
    }
    
    /**
     * @param string $email
     * @return mixed
     */
    public function loadUserByEmail(string $email)
    {
        return $this->classes->user::whereEmail($email)->first();
    }
    
    /**
     * @param string $username
     * @return mixed
     */
    public function loadUserByUsername(string $username)
    {
        return $this->classes->user::whereUsername($username)->first();
    }
    
    /**
     * User not exists.
     *
     */
    public function notExists()
    {
        return Result::unauthorized("Le nom d'utilisateur ou l'adresse mail n'existe pas");
    }
    
    /**
     * Wrong password.
     *
     */
    public function wrongPassword()
    {
        return Result::unauthorized("Le mot de passe est incorrect");
    }
    
    /**
     * Account is not active.
     *
     */
    public function notActive()
    {
        return Result::forbidden("Votre compte n'est pas encore actif. Merci de bien vouloir valider votre adresse e-mail.");
    }
    
    /**
     * Unauthorized.
     *
     */
    public function unauthorized()
    {
        return Result::unauthorized("Vous n'êtes pas autorisé à accéder à ce service.");
    }
    
    /**
     * Forbidden.
     *
     */
    public function forbidden()
    {
        return Result::forbidden("Vous n'êtes pas autorisé à accéder à ce service.");
    }
    
    /**
     * Generate token
     *
     * @param $user
     * @param string $password
     * @param bool $remember
     * @return Success|Error|bool|string
     */
    public function generateToken($user, string $password, bool $remember = false)
    {
        if ($user === null)
            return $this->notExists();
        
        if (($claims = $user->getJWTCustomClaims()) === null || count($claims) === 0)
            $claims = [
                'user' => [
                    'id'       => $user->getAttributeValue('username'),
                    'email'    => $user->getAttributeValue('email'),
                    'username' => $user->getAttributeValue('username'),
                ]
            ];
        
        return auth()
            ->claims($claims)
            ->setTtl($this->getTTL($remember))
            ->attempt(["email" => $user->getAttributeValue('email'), "password" => $password]);
    }
    /**
     * @param bool $remember
     * @return int
     */
    public function getTTL(bool $remember = false)
    {
        return $remember ? 525600 : 1440;
    }
    
    /**
     * @param mixed $values
     * @param array $fields
     * @param null $validator
     * @return bool
     */
    public function validate($values, array $fields = [], $validator = null): bool
    {
        $validator = $validator ?? [
                'lastname',
                'firstname',
                'username',
                'email',
                'password',
            ];
        $fields = collect($fields)->count() === 0 ? $validator : $fields;
        $values = Helpers::toObject($values);
        
        foreach ($fields as $field) {
            if (!isset($values->$field) || !$values->$field || trim($values->$field) === '')
                return false;
        }
        return true;
    }
    
    /**
     * @return stdClass
     */
    public function getClasses(): stdClass
    {
        return $this->classes;
    }
}