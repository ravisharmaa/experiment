<?php

namespace App\Inspections;

class AttributeLoad
{
    protected $isCritical = false;

    public function inspect($loadType, $loadValue, $limitArray)
    {
        return $this->isExceed($loadType, $loadValue, $limitArray);
    }

    private function isExceed($loadType, $value, $limitArray)
    {
        if ($value > $limitArray['critical_threshold'] ||
            $value === $limitArray['critical_threshold']) {
            $this->isCritical = true;
        }


        if ($value > $limitArray['warning_threshold'] ||
               $value === $limitArray['warning_threshold']) {
                $level = ($this->isCritical) ? 'critical' : 'warning';
                return [
                   false,
                   ucfirst("${loadType} exceeds ${level} threshold limit."),
               ];
            }

            return [
               true,
               ucfirst("${loadType} exceeds maximum threshold."),
           ];
    }
}
