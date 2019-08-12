<?php

namespace App\Jobs;

use App\Mail\ReportSystemIssue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class ComposeEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $emailData;
    protected $emailAddresses;

    /**
     * ComposeEmails constructor.
     *
     * @param $emailAddresses
     * @param $emailData
     */
    public function __construct($emailAddresses, $emailData)
    {
        $this->emailAddresses = $emailAddresses;
        $this->emailData = $emailData;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Mail::to(['email' => $this->emailAddresses])
            ->send(new ReportSystemIssue($this->emailData));
    }
}
