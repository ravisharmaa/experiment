<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class Entity extends Model
{
    protected $guarded = [];

    protected $with = ['latestValue'];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function values()
    {
        return $this->hasMany(Value::class);
        // return $this->where('created_at', '>=', Carbon::now()->subHour());
    }

    public function addValues($value)
    {
        // Get all of the columns from the particular table
        $tableColumns = Schema::connection('mysql')->getColumnListing('values');

        $additionalData = [];

        collect($value)->keys()->map(function ($column) use (&$value, &$additionalData, $tableColumns) {
            if (!in_array($column, $tableColumns)) {
                $additionalData[$column] = $value[$column];
                unset($value[$column]);
            }
        })->toArray();

        $value['additional_attributes'] = json_encode($additionalData);

        return $this->values()->create($value);
        //  map the keys of the csv values using the tables columns to check if the column exits in the table
        /*$additionalValues = [];
        foreach ($value as $key => $val) {
            if ( !in_array ( $key, $tableColumns )) {
                $additionalValues[$key] = $value[$key];
                unset($value[$key]);
            }
        } */
    }

    /**
     *  Gets a single instance from has many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function latestValue()
    {
        return $this->hasOne(Value::class)->latest();
    }

    /**
     * Gets a collection of latest values from the relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function latestValues()
    {
        $period = request()->period;

        switch ($period) {
            case 'last_hour':

            return $this->hasMany(Value::class)->where('created_at', '>=', Carbon::now()->subHours(1));

            break;

            case 'today':

                return $this->hasMany(Value::class)->where('created_at', '>=', Carbon::now()->subHours(24));

            break;

            case 'week':

                return $this->hasMany(Value::class)->where('created_at', '>=', Carbon::now()->subDays(7));

            break;

            case 'month':

                return $this->hasMany(Value::class)->where('created_at', '>=', Carbon::now()->subMonth());

            break;

            case 'year':

                return $this->hasMany(Value::class)->where('created_at', '>=', Carbon::now()->subYear());

            break;

            default:

             return $this->hasMany(Value::class)->where('created_at', '>=', Carbon::now()->subHour());
        }

        //return $this->values()->latest();
       //return $this->hasMany(Value::class)->where('created_at', '>=', Carbon::now()->subHour());

       //SELECT HOUR(created_at) , AVG(loadaverage), CURDATE(), `values`.* FROM `values` WHERE entity_id = 2 and  DATE(created_at) = CURDATE()  GROUP by HOUR(created_at)
    }
}
