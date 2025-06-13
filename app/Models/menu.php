<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class menu extends Model
{
    protected $table = 'menu';
    use SoftDeletes;
}
