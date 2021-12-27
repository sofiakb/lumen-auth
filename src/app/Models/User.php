<?php
/**
 * lumen-auth
 * This file contains User class.
 *
 * Created by PhpStorm on 27/12/2021 at 15:56
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Models
 * @file Sofiakb\Lumen\Auth\Models\User
 */

namespace Sofiakb\Lumen\Auth\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Lumen\Auth\Authorizable;
use Sofiakb\Tools\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class User
 * @property $id
 * @property $username
 * @property $lastname
 * @property $firstname
 * @property $email
 * @property $active
 * @property $password
 *
 * @method static User|Builder whereId($value)
 * @method static User|Builder whereUsername($value)
 * @method static User|Builder whereEmail($value)
 * @method static User|Builder whereLastname($value)
 * @method static User|Builder whereFirstname($value)
 * @method static User|Builder whereActive($value)
 * @method static User|Builder create($value)
 *
 * @package Sofiakb\Lumen\Auth\Models
 * @author Sofiane Akbly <sofiane.akbly@gmail.com>
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname', 'firstname', 'username', 'email', 'password', 'active'
    ];
    
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active'            => 'boolean'
    ];
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    
    /**
     * Activate current account
     *
     * @return bool
     */
    public function activate()
    {
        return $this->update(['active' => true]);
    }
    
    /**
     * Deactivate current account
     *
     * @return bool
     */
    public function deactivate()
    {
        return $this->update(['active' => false]);
    }
}