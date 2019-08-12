<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Server;

class Attribute extends Model
{
    protected $fillable = [];

    public function servers()
    {
        return $this->belongsToMany(Server::class)
            ->withPivot('critical_threshold','warning_threshold','email');
    }
}
