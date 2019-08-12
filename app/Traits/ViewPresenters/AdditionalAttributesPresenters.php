<?php
/**
 * Created by PhpStorm.
 * User: ravi
 * Date: 2/13/19
 * Time: 12:17 PM.
 */

namespace App\Traits\ViewPresenters;

use App\Server;

trait AdditionalAttributesPresenters
{
    /**
     * @param Server $server
     *
     * @return array
     */
    protected function bakeAdditionalAttributes(Server $server, $timeInterval): array
    {
        $services_data = [];

        $service = [];

        foreach ($server->services as $services) {
            $services_data[] = strtolower($services->service_name);
        }

        foreach ($server['latest_values'] as $value) {
            if (is_object($value->additional_attributes)) {
                foreach ($value->additional_attributes as $key => $pair) {
                    if (in_array($pair->name, $services_data)) {
                        $service[$key][] = [$value->created_at->timestamp * 1000, $pair->status];
                    }
                }
            }
        }

        return $service;
    }

    /**
     * @param Server $server
     * @param $attribute
     *
     * @return array
     */
    protected function extractAttributeInformation(Server $server, $attribute): array
    {
        $collectionArray = [];
        $dateArray = $server->latest_values->pluck('created_at')->toArray();
        $attributeArray = $server->latest_values->pluck($attribute)->toArray();


        for ($i = 0; $i < count($dateArray); ++$i) {
            $collectionArray[$i] = [$dateArray[$i]->timestamp * 1000, $attributeArray[$i]];
        }

        return $collectionArray;
    }
}
