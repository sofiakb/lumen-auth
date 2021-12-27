<?php
/**
 * lumen-auth
 * This file contains RegisterService class.
 *
 * Created by PhpStorm on 27/12/2021 at 14:25
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Services
 * @file Sofiakb\Lumen\Auth\Services\RegisterService
 */

namespace Sofiakb\Lumen\Auth\Services;

use Sofiakb\Tools\Helpers;
use Sofiakb\Tools\Result\Error;
use Sofiakb\Tools\Result\Result;
use Sofiakb\Tools\Result\Success;

/**
 * Class RegisterService
 * @package Sofiakb\Lumen\Auth\Services
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class RegisterService extends AuthService
{
    /**
     * @param $data
     * @return Success|Error|array|null|string
     */
    public function register($data)
    {
        if (($data === null) || Helpers::toObject($data) === null)
            return null;
        
        $data->username = $data->username ?? (isset($data->firstname) && isset($data->lastname) ? str_replace(" ", "", strtolower(substr($data->firstname, 0, 1) . $data->lastname)) : $data->email);
        $data->password = Helpers::bcrypt($data->password);
        
        foreach ($data as $key => $value)
            if ($key !== 'password')
                $data->$key = mb_strtolower($value);
        
        return $this->loadUserByUsername($data->username) === null && $this->loadUserByEmail($data->email) === null
            ? $this->getClasses()->user::create(Helpers::toArray($data))
            : Result::duplicate("Un compte existe déjà avec cette adresse mail ou ce nom d'utilisateur");
    }
    
    /**
     * @param $data
     * @return bool
     */
    public function store($data): bool
    {
        return ($result = $this->register($data)) && !Error::is($result);
    }
}