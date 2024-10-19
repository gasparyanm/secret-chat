<?php

namespace App\Services\Crypt;

interface CryptInterface
{
    public function encryptMessage(string $message, string $key): string;
    public function decryptMessage(string $hash, string $key): string;
    public function generateDecryptionKey(): string;
}
