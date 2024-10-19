<?php

namespace App\Repositories;

use App\Models\Message;
use Carbon\Carbon;

class MessageRepository
{
    public function create(
        string $messageHash,
        string $recipient,
        string $decryptionKey,
        ?Carbon $expiryAt = null
    ): Message
    {
        $message = new Message();
        $message->text = $messageHash;
        $message->recipient = $recipient;
        $message->decryption_key = $decryptionKey;
        $message->expires_at = $expiryAt;
        $message->save();

        return $message;
    }

    public function getRecipientMessageByKey(string $decryptKey, string $recipient): ?Message
    {
        return Message::query()
            ->where('recipient', $recipient)
            ->where('decryption_key',$decryptKey)
            ->first();
    }
}
