<?php

namespace App\Services\Crypt;

use Illuminate\Support\Facades\Crypt;

class CryptService implements CryptInterface
{
    private const CRYPT_ALGORITHM = 'AES-256-CBC';
    private const SEPARATOR = '::';

    /**
     * @throws \Exception
     */
    public function encryptMessage(string $message, string $key): string
    {
        $iv = random_bytes(openssl_cipher_iv_length(self::CRYPT_ALGORITHM));

        $encrypted = openssl_encrypt($message, self::CRYPT_ALGORITHM, $key, 0, $iv);

        return base64_encode($encrypted . self::SEPARATOR . $iv);
    }

    public function decryptMessage(string $hash, string $key): string
    {
        list($encryptedData, $iv) = explode(self::SEPARATOR, base64_decode($hash), 2);

        return openssl_decrypt($encryptedData, self::CRYPT_ALGORITHM, $key, 0, $iv);
    }

    /**
     * @throws \Exception
     */
    public function generateDecryptionKey(): string
    {
        return bin2hex(random_bytes(16));
    }
}
