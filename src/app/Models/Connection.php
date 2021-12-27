<?php
/**
 * lumen-auth
 * This file contains Connection class.
 *
 * Created by PhpStorm on 27/12/2021 at 15:55
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Lumen\Auth\Models
 * @file Sofiakb\Lumen\Auth\Models\Connection
 */

namespace Sofiakb\Lumen\Auth\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Sofiakb\Lumen\Auth\Services\AuthService;
use Sofiakb\Tools\Model;

/**
 * Class Connection
 * @package Sofiakb\Lumen\Auth\Models
 * @author Sofiakb <contact.sofiak@gmail.com>
 */
class Connection extends Model
{
    /**
     * @var bool
     */
    protected static $unguarded = true;
    
    /**
     * @var string[]
     */
    protected $with = ['user'];
    
    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(AuthService::userClass());
    }
}