<?php

namespace App\Observers;

use App\Monitor\MaxThreshold;
use App\Traits\AttributesMapper;
use App\Value;

class ValuesObserver
{
    use AttributesMapper;

    protected $thresholdAttributes = [];
    protected $thresholdLimits = [];
    protected $notifiable;

    /**
     * Handle the value "created" event.
     *
     * @param \App\Value $value
     */
    public function created(Value $value)
    {
        $this->bakeThreshold($value);
        $this->notifiable = $value->server->customers[0]->email; //$attribute->pivot->email;
        $maxThreshold = resolve(MaxThreshold::class);
        $maxThreshold->attributesInspector = $this->thresholdAttributes;
        $maxThreshold->thresholdLimits = $this->thresholdLimits;
        $maxThreshold->monitor($value->server->hostname, $value->server->ipaddress, $this->notifiable);
    }

    /**
     * @param Value $value
     *
     * @return object
     */
    protected function extractDiskInfo(Value $value)
    {
        $diskInfo = [];

        foreach ($value->disktotal as $disk => $storage) {
            $diskInfo[explode('_', $disk)[0]]['disktotal'] = $storage;
        }

        foreach ($value->diskused as $disk => $storageUsed) {
            $diskInfo[explode('_', $disk)[0]]['diskused'] = $storageUsed;
        }

        return (object) $diskInfo;
    }

    /**
     * @param Value $value
     */
    protected function bakeThreshold(Value $value): void
    {
        $diskInfos = $this->extractDiskInfo($value);
        $this->prepareDiskAttribute($diskInfos);

        $this->prepareMemoryAndCpu($value);

        $this->prepareAdditionalData($value);
    }

    /**
     * @param $diskInfos
     */
    protected function prepareDiskAttribute($diskInfos): void
    {
        foreach ($diskInfos as $disk => $diskInfo) {
            $this->thresholdAttributes[strtolower("disk-${disk}")] = $this->mapAttributeForInspector('disk', (object) $diskInfo);
        }
    }

    /**
     * @param Value $value
     */
    protected function prepareMemoryAndCpu(Value $value): void
    {
        foreach ($value->server->attributes as $attribute) {
            if ('disk' === strtolower($attribute->name)) {
                $this->thresholdLimits[strtolower('disk-'.$attribute->pivot->disk_name)]['critical_threshold'] = $attribute->pivot->critical_threshold;
                $this->thresholdLimits[strtolower('disk-'.$attribute->pivot->disk_name)]['warning_threshold'] = $attribute->pivot->warning_threshold;
            } else {
                $this->thresholdAttributes[strtolower($attribute->name)] = $this->mapAttributeForInspector(strtolower($attribute->name), $value);
                $this->thresholdLimits[strtolower($attribute->name)]['critical_threshold'] = $attribute->pivot->critical_threshold;
                $this->thresholdLimits[strtolower($attribute->name)]['warning_threshold'] = $attribute->pivot->warning_threshold;
            }
        }
    }

    /**
     * @param Value $value
     */
    protected function prepareAdditionalData(Value $value): void
    {
        foreach ($value->additional_attributes as $additionalAttribute) {
            $this->thresholdAttributes[$additionalAttribute->name] = $this->mapAttributeForInspector($additionalAttribute->name, $additionalAttribute->status);
        }
    }
}
