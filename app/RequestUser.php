<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RequestUser extends Pivot
{
    protected $table = 'request_users';
    public $timestamps = false;
    protected $guarded = [];
}
