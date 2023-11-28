<?php

namespace Modules\Downloads\Entities;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = [
        'description',
        'name',
        'package',
        'file_path',
        'allow_guest',
       
    ];
}
