<?php

namespace App\Services;

use App\Enums\MessageExpiryEnum;
use App\Jobs\DeleteExpireMessageJob;
use App\Models\Message;
use App\Repositories\MessageRepository;
use Exception;

class MessageService
{
    public function __construct(private readonly MessageRepository $messageRepository)
    {
    }

    public function create(
        string $messageHash,
        string $recipient,
        string $decryptionKey,
        string $expiryOption
    ): Message
    {
        $expiryAt = $expiryOption === MessageExpiryEnum::Once->value ? null : now()->addDay();

        $message = $this->messageRepository->create($messageHash, $recipient, $decryptionKey, $expiryAt);

        if (!is_null($expiryAt)) {
            DeleteExpireMessageJob::dispatch($message)->delay($expiryAt);
        }

        return $message;
    }

    /**
     * @throws Exception
     */
    public function getMessageHash(string $decryptKey, string $recipient): string
    {
        $message = $this->messageRepository->getRecipientMessageByKey($decryptKey, $recipient);

        if(is_null($message)) {
            throw new Exception('Your provided decrypt key is invalid!');
        }

        if ($message->is_read) {
            throw new Exception('Message has already been read.');
        }

        $messageHash = $message->text;

        if (is_null($message->expires_at)) {
//            $message->is_read = true;
//            $message->save();
//        } else {
//            delete after recipient read
            DeleteExpireMessageJob::dispatch($message);
        }

        return $messageHash;
    }
}
