<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class MatchUser extends Pivot
{
    protected $table = 'match_users';
    public $timestamps = false;
    protected $guarded = [];
}
