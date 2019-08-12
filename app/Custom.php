<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    protected $guarded = [];

    public function server()
    {
        return $this->belongsToMany(Server::class);
    }
}
