<?php

namespace App\Traits;

use App\Models\User;
use NotificationChannels\Telegram\TelegramMessage;

trait NotificationCheckStatus
{
    public function getDetailDomain(): string
    {
        return $this->getMonitor()->label . ' - ' . $this->getMonitor()->url;
    }

    public function getUser(): User
    {
        return $this->getMonitor()->user;
    }

    public function via($notifiable)
    {
        $channels = [];

        $user = $this->getUser();

        $userEmail = $user->email;
        if($userEmail) {
            $channels[] = 'mail';
        }

        $userSlackWebhookUrl = $user->slack_webhook_url;
        if($userSlackWebhookUrl) {
            $channels[] = 'slack';
        }

        $userTelegramId = $user->telegram_id;
        if($userTelegramId) {
            $channels[] = 'telegram';
        }

        return $channels;
    }

    public function toTelegram($notifiable)
    {
        $userTelegramId = $this->getUser()->telegram_id;

        $telegramMessage = TelegramMessage::create($this->getMessageText())
            ->to($userTelegramId)
            ->line($this->getLocationDescription());

        foreach ($this->getMonitorProperties() as $name => $value) {
            $telegramMessage->line($name.': '.$value);
        };

        return $telegramMessage;
    }
}
