<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Value extends Model
{
    protected $guarded = [];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function getdisktotalAttribute($value)
    {
        return json_decode($value);
    }

    public function getdiskUsedAttribute($value)
    {
        return json_decode($value);
    }

    /*  public function getCreatedAtAttribute($value)
      {
          return '2018-6-16';
          return Carbon::parse($value)->timestamp;
      }*/

    public function getAdditionalAttributesAttribute($value)
    {
        return json_decode($value);
    }

    public function scopeApplyFilterFor($query, $timeInterval)
    {
        switch ($timeInterval) {
            case 'last_hour':
            default:
                return $query->select(
                    DB::raw('
                               loadaverage loadaverage,
                               memtotal memtotal,
                               memfree memfree,
                               (memtotal-memfree) memused,
                               created_at,
                               additional_attributes')
                )->where('created_at', '>=', Carbon::now()->subHour(1))->get();
            case 'today':
                return $query->select(
                    DB::raw('
                               loadaverage loadaverage,
                               memtotal memtotal,
                               memfree memfree,
                               (memtotal-memfree) memused,
                               created_at,
                               additional_attributes')
                )->whereRaw('date(created_at) = curdate()')->get();
            case 'week':
                return $query->select(
                    DB::raw('
                               loadaverage loadaverage,
                               memtotal memtotal,
                               memfree memfree,
                               (memtotal-memfree) memused,
                               systemuptime,
                               created_at,
                               additional_attributes')
                )->whereRaw('date(created_at) > (now() - interval 7 day)')
                    ->get();
            case 'month':
                return $query->select(
                    DB::raw('
                               loadaverage loadaverage,
                               memtotal memtotal,
                               memfree memfree,
                               (memtotal-memfree) memused,
                               created_at,
                               additional_attributes')
                )->whereRaw('month(date(created_at)) = month(curdate())')
                    ->get();

            case 'year':
                return $query->select(
                    DB::raw('
                               loadaverage loadaverage,
                               memtotal memtotal,
                               memfree memfree,
                               systemuptime,
                               created_at,
                               additional_attributes')
                )->whereRaw('year(date(created_at)) = year(curdate())')
                    ->get();
        }
    }
}
