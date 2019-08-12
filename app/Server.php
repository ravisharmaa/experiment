<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Server extends Model
{
    protected $guarded = [];
    protected $with = ['latestValue', 'attributes', 'customer', 'services', 'customs'];

    /**
     *  Gets a single instance from has many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function latestValue()
    {
        return $this->hasOne(Value::class, 'id', 'latest_value_id')->latest();
    }

    /**
     *  Gets a single instance from has many relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */

    public function scopeWithLatestValue($query)
    {
        $query->addSubSelect('latest_value_id', Value::select('id')
            ->whereRaw('server_id = servers.id')
            ->latest()
        )->with('latestValue');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
   /* public function customers()
    {
        return $this->belongsTo(Customer::class)
            ->select('customers.name','customers.contact_person','customers.id','customers.email');
    }*/

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class, 'server_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customs()
    {
        //return $this->hasMany(Custom::class, 'server_id')->select('path','result');
        return $this->hasMany(Custom::class, 'server_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class)
            ->select('attributes.name', 'attributes.id')
            ->withPivot('id', 'warning_threshold', 'critical_threshold', 'email', 'disk_name', 'disk_location', 'visibility')
            ->orderBy('attribute_id')
            ->distinct();
    }

    public function getAttributeByName($name)
    {
        return $this->attributes()->whereName($name)->get();
        // reduce this n+1 query
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(Value::class);
    }

    /**
     * @param $value
     *
     * @return Model
     */
    public function addValues($value)
    {
        $tableColumns = Schema::getColumnListing('values');

        $additionalData = [];
        $disk = [
            'disktotal' => [],
            'diskused' => [],
        ];
        $custom = [];

        collect($value)->keys()->map(function ($column) use (&$value, &$additionalData, $tableColumns, &$disk, &$custom) {
            if ((str_contains($column, 'disktotal'))) {
                $disk['disktotal'][$column] = rtrim($value[$column], 'G');
                unset($value[$column]);
            } elseif (str_contains($column, 'diskused')) {
                $disk['diskused'][$column] = rtrim($value[$column], 'G');
                unset($value[$column]);
            } elseif (str_contains($column, 'custom')) {
                $custom[$column]['field_name'] = $column;
                $custom[$column]['field_value'] = $value[$column];
                unset($value[$column]);
            } elseif (!in_array($column, $tableColumns)) {
                $additionalData[$column]['name'] = $column;
                $additionalData[$column]['status'] = ('open' === $value[$column]) ? 1 : 0;
                unset($value[$column]);
            }
        });

        $value['disktotal'] = json_encode($disk['disktotal']);
        $value['diskused'] = json_encode($disk['diskused']);
        $value['custom_field'] = json_encode($custom);
        $value['additional_attributes'] = json_encode($additionalData);

        return $this->values()->create($value);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function getServer($id)
    {
        $server = DB::table('services')
            ->join('servers', 'services.id', '=', 'servers.service_id')
            ->where('servers.service_id', '=', $id)
            ->select('servers.*')
            ->get();

        return $server;
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'hostname';
    }
}
