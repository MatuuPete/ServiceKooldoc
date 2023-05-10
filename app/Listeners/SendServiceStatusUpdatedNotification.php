<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ServiceStatusUpdated;
use App\Mail\ServiceStatusUpdatedNotification;
use App\Mail\AdminServiceStatusUpdatedNotification;
use Mail;

class SendServiceStatusUpdatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ServiceStatusUpdated $event)
    {
        $user = $event->service->customer->user;

        $technician_emails = $event->service->technicians()
            ->wherePivot('service_id', $event->service->id)
            ->with('user')
            ->get()
            ->pluck('user.email')
            ->toArray();

        $admin = $event->service->admin->user;

        $email = optional($user)->email ?: 'kooldocbusiness@gmail.com';
        Mail ::to($email)->send(new ServiceStatusUpdatedNotification($event->service));

        Mail::to($admin->email)->cc($technician_emails)->send(new AdminServiceStatusUpdatedNotification($event->service));
    }
}
