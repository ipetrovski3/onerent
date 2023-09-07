<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use App\Services\SendEmailsService;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NewBookingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $client;
    public $booking;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($client, $booking)
    {
        $this->client = $client;
        $this->booking = $booking;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admin_email = User::first()->email;
        $sendEmailsService = new SendEmailsService;
        $sendEmailsService->send_emails($admin_email, $this->client->email, $this->booking, $this->client);
    }
}
