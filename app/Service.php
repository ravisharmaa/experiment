<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Service extends Model
{
    protected $guarded = [];

    public function getService($id)
    {
        $service = DB::table('servers')
            ->join('services', 'servers.id', '=', 'services.server_id')
            ->where('services.server_id', '=', $id)
            ->select('services.*')
            ->get();

        return $service;
    }

    public function server()
    {
        return $this->belongsToMany(Server::class);
    }
}
