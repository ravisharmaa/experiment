<?php

namespace App\Monitor;

use App\Inspections\AttributeLoad;
use App\Inspections\Connection;
use App\Events\CriticalSystemIssueDetected;
use Illuminate\Support\Facades\Log;

class MaxThreshold
{
    public $attributesInspector = [];
    public $thresholdLimits = [];

    protected $inspections = [
        AttributeLoad::class => [],
        Connection::class => [],
    ];

    public function monitor($hostName, $ipAddress, $notifiableEmail)
    {
        foreach ($this->attributesInspector as $attribute => $value) {
            if (is_bool($value)) {
                $this->inspections[Connection::class][$attribute] = $value;
            } elseif (is_float($value)) {
                $this->inspections[AttributeLoad::class][$attribute] = $value;
            }
        }

        $messages = [];
        foreach ($this->inspections as $inspector => $attributes) {
            foreach ($attributes as $attribute => $value) {
                if (app($inspector) instanceof AttributeLoad) {
                    list($status, $message) = app($inspector)->inspect($attribute, $value, $this->thresholdLimits[$attribute]);
                } else {
                    list($status, $message) = app($inspector)->inspect($attribute, $value);
                }

                if (!$status) {
                    $messages[] = $message;
                }
            }
        }

        // check for any message
        if (count($messages)) {
            // fire event
            if ('local' === app()->environment()) {
                // Log::info("Message: {$hostName}{$ipAddress}{$notifiableEmail}", $messages);
                event(new CriticalSystemIssueDetected($messages, $hostName, $ipAddress, $notifiableEmail));
            } else {
                event(new CriticalSystemIssueDetected($messages, $hostName, $ipAddress, $notifiableEmail));
            }
        }

        return;
    }

    private function getNumericValue($haystack)
    {
        preg_match_all('/[0-9]+(\.[0-9]+)?/', $haystack, $result);

        return $result[0][0];
    }
}
