<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Service;

class ServiceStatusUpdatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $service;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('/customer-profile');
        return $this->markdown('emails.service-status-updated')
            ->subject('Service Status Updated')
            ->with([
                'service' => $this->service,
                'url' => $url,
            ]);
    }
}
