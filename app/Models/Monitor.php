<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Monitor extends \Spatie\UptimeMonitor\Models\Monitor
{
    /**
     * Get the user that owns the Monitor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
