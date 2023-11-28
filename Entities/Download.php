<?php

namespace Modules\Downloads\Entities;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{

    protected $table = 'downloads';
    protected $primaryKey = 'id';
}
