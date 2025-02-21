<?php

namespace App\Listeners;

use App\Models\UptimeLog;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Spatie\UptimeMonitor\Events\UptimeCheckSucceeded as Event;

class UptimeCheckSucceeded
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Event $event): void
    {
        UptimeLog::create([
            'monitor_id' => $event->monitor->id,
            'url' => $event->monitor->raw_url,
            'label' => $event->monitor->label,
            'status' => $event->monitor->uptime_status,
            'response_time' => 0,
        ]);
    }
}
