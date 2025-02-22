<?php

namespace App\Notifications\Certificate;

use App\Traits\NotificationCheckStatus;

class CertificateCheckFailed extends \Spatie\UptimeMonitor\Notifications\Notifications\CertificateCheckFailed
{
    use NotificationCheckStatus;

    public function getMessageText(): string
    {
        return "SSL Certificate for {$this->getDetailDomain()} is invalid";
    }
}
