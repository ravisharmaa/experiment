<?php
/**
 * Created by PhpStorm.
 * User: ravi
 * Date: 1/30/19
 * Time: 12:59 PM.
 */

namespace App\Traits;

trait AttributesMapper
{
    private function mapAttributeForInspector($attribute, $value)
    {
        switch (strtolower($attribute)) {
            case 'cpu':
                return (float) $value->loadaverage;
            case 'memory':
                return  $this->calculateMemory((float) $value->memtotal, (float) $value->memfree);
            case 'disk':
                return $this->calculateDisk((float) $value->disktotal, (float) $value->diskused);
            default:
                return (bool) $value;
        }
    }

    private function getNumericValue($haystack)
    {
        preg_match_all('/[0-9]+(\.[0-9]+)?/', $haystack, $result);

        return $result[0][0];
    }

    private function calculateMemory($totalMemory, $freeMemory)
    {
        if ((0 === $totalMemory || 0 === $freeMemory)) {
            return 0;
        }

        return round(($freeMemory / $totalMemory) * 100);
    }

    private function calculateDisk($diskTotal, $diskUsed)
    {
        if ((0 === $diskTotal || 0 === $diskUsed)) {
            return 0;
        }

        return ceil(($diskUsed / $diskTotal) * 100);
    }
}
