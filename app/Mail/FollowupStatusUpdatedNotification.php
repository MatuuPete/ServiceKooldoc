<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\FollowupService;

class FollowupStatusUpdatedNotification extends Mailable
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
        $url = url('/customer-profile');
        return $this->markdown('emails.followup-status-updated')
            ->subject('Follow-up Service Status Updated')
            ->with([
                'followup_service' => $this->followup_service,
                'url' => $url,
            ]);
    }
}
