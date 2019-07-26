<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Item extends Model
{
    protected $table = 'items';

    protected $guarded = [];
}
