<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;


class ExecuteBashScript
{

    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        $role = $event->user->role;
        $user = $event->user->username;
        $password = $event->password;

        // Execute Bash only in production
        if ((app()->environment() === 'production') && ($role === 'admin'))  {
            $command = "/scripts/client.pl '/scripts/adduser.sh ${user} ${password}'";
            exec($command, $output);
            Log::info("Executed bash command ${command} with output \n " . json_encode($output)) ;
        } else {
            Log::info("New user added with ${user}");
        }


    }
}
