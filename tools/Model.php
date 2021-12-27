<?php
/**
 * This file contains Model class.
 *
 * Created by PhpStorm on 27/12/2021 at 15:51
 *
 * @author Sofiakb <contact.sofiak@gmail.com>
 * @package Sofiakb\Tools
 * @file Sofiakb\Tools\Model
 */

namespace Sofiakb\Tools;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as BaseModel;
use Illuminate\Support\Carbon;

/**
 * Class Model
 * @package Sofiakb\Tools
 * @author Sofiakb <contact.sofiak@gmail.com>
 *
 * @method static Builder|static newModelQuery()
 * @method static Builder|static newQuery()
 * @method static Builder|static query()
 * @mixin \Illuminate\Database\Query\Builder
 * @mixin Builder
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @method static Builder|static where($param, $value = null)
 * @method static Builder|static whereId($value)
 * @method static Builder|static whereUpdatedAt($value)
 * @method static Builder|static whereCreatedAt($value)
 * @method static Builder|static whereDeletedAt($value)
 * @method static Builder|static create(array $array)
 * @method static Builder|static whereIn(string $column, mixed $values)
 * @method static int count()
 *
 * @mixin  Model
 * @mixin Builder|\Illuminate\Database\Schema\Builder
 */
class Model extends BaseModel
{

}