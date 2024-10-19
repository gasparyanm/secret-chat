<?php

namespace App\Jobs;

use App\Models\Message;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DeleteExpireMessageJob implements ShouldQueue
{
    use Queueable;

    public function __construct(public Message $message)
    {
    }

    public function handle(): void
    {
        $this->message->delete();
    }
}
