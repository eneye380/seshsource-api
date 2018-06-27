<?php

namespace SeshSource;

use SeshSource\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class CheckIns extends Model
{
    use Uuids;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
}
