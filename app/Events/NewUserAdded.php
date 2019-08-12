<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class NewUserAdded
{
    use SerializesModels;

    public $user;
    public $password;

    /**
     * NewUserAdded constructor.
     *
     * @param $user
     * @param $password
     */
    public function __construct($user, $password)
    {
        $this->password = $password;
        $this->user = $user;
    }
}
