<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerServer extends Model
{
    protected $guarded = [];
    protected $table = 'customer_server';

    public $timestamps = false;
}
