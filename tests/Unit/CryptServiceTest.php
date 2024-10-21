<?php

namespace Tests\Unit;

use App\Services\Crypt\CryptService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CryptServiceTest extends TestCase
{
    use RefreshDatabase;

    private CryptService $cryptService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->cryptService = new CryptService();
    }

    public function testEncryptMessage()
    {
        $message = 'Hello, World!';
        $key = 'testkey1234567890';

        $encryptedMessage = $this->cryptService->encryptMessage($message, $key);

        $this->assertNotEquals($message, $encryptedMessage);
    }

    public function testDecryptMessage()
    {
        $message = 'Hello, World!';
        $key = 'testkey1234567890';

        $encryptedMessage = $this->cryptService->encryptMessage($message, $key);
        $decryptedMessage = $this->cryptService->decryptMessage($encryptedMessage, $key);

        $this->assertEquals($message, $decryptedMessage);
    }

    public function testGenerateDecryptionKey()
    {
        $key = $this->cryptService->generateDecryptionKey();

        $this->assertEquals(32, strlen($key)); // 16 bytes hex is 32 characters
    }
}
