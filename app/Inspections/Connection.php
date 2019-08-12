<?php

namespace App\Inspections;

class Connection
{
    public function inspect($connection, $value)
    {
        if (!$value) {
            return [false, ucfirst("${connection} is down")];
        }

        return [true, ucfirst("${connection} is up and running")];
    }
}