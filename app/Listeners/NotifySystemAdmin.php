<?php

namespace App\Listeners;

use App\Jobs\ComposeEmails;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportSystemIssue;

class NotifySystemAdmin
{
    use DispatchesJobs;
    /**
     * Handle the event.
     *
     * @param object $event
     */
    public function handle($event)
    {
        $data = [
            'messages' => $event->message,
            'hostName' => $event->hostName,
            'ipAddress' => $event->ipAddress,
            'email' => [$event->notifiable],
        ];
        $data['email'][] = 'satya.maharjan@javra.com'; //@TODO temporary

        foreach($data['email'] as $email) {
            try {

                dispatch(new ComposeEmails($email, $data))->delay(now()->addMinutes(1));
               /* Mail::to(['email' => $email])
                    ->send(new ReportSystemIssue($data));*/
            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }
        }

    }
}
