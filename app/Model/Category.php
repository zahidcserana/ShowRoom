<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Category extends Model
{
    protected $table = 'categories';

    protected $guarded = [];
}
