<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\FollowupService;

class AdminFollowupServiceScheduleNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $followup_service;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(FollowupService $followup_service)
    {
        $this->followup_service = $followup_service;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.admin-followup-service-schedule')
            ->subject('Customer Follow-up Schedule')
            ->with([
                'service' => $this->followup_service,
            ]);
    }
}
