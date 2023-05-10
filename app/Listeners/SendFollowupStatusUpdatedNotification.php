<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\FollowupStatusUpdated;
use Mail;
use App\Mail\FollowupStatusUpdatedNotification;
use App\Mail\AdminFollowupStatusUpdatedNotification;

class SendFollowupStatusUpdatedNotification
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
    public function handle(FollowupStatusUpdated $event)
    {
        $user = $event->followup_service->service->customer->user;

        $technician_emails = $event->followup_service->technicians()
            ->wherePivot('followup_service_id', $event->followup_service->id)
            ->with('user')
            ->get()
            ->pluck('user.email')
            ->toArray();

        $admin = $event->followup_service->service->admin->user;

        $email = optional($user)->email ?: 'kooldocbusiness@gmail.com';
        Mail ::to($email)->send(new FollowupStatusUpdatedNotification($event->followup_service));

        Mail::to($admin->email)->cc($technician_emails)->send(new AdminFollowupStatusUpdatedNotification($event->followup_service));
    }
}
