<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class CriticalSystemIssueDetected
{
    use SerializesModels;

    public $message;
    public $hostName;
    public $ipAddress;
    public $notifiable;

    /**
     * Create a new event instance.
     *
     * @param $message
     * @param $hostName
     * @param $ipAddress
     * @param $notifiable
     */
    public function __construct($message, $hostName, $ipAddress, $notifiable)
    {
        $this->message = $message;
        $this->hostName = $hostName;
        $this->ipAddress = $ipAddress;
        $this->notifiable = $notifiable;

    }

}
