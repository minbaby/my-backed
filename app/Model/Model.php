<?php

declare(strict_types=1);


namespace App\Model;

use Hyperf\Database\Model\SoftDeletes;
use Hyperf\DbConnection\Model\Model as BaseModel;

abstract class Model extends BaseModel
{
    use SoftDeletes;

    protected $hidden = ['deleted_at'];
}
