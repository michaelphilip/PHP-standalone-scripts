<?php

namespace Standalone\Test;

use PHPUnit\Framework\TestCase;
use Standalone\Security\CryptAes256;

class CryptAes256Test extends TestCase
{
    private $secretKey;
    private $ivKey;

    /**
     * @var CryptAes256
     */
    private $cryptAes256;

    public function setUp(): void
    {
        $this->secretKey = '25c6c7ff35b9979b151f2136cd13b0ff';
        $this->ivKey = 'aoe92js74ekke22s';
        $this->cryptAes256 = new CryptAes256($this->secretKey, $this->ivKey);
    }

    public function testEncrypt(): void
    {
        $message = $this->cryptAes256->encryptMessage('Test Message');
        $this->assertIsString($message);
    }

    public function testDecrypt(): void
    {
        $message = $this->cryptAes256->encryptMessage('Test Message');
        $decrypt = $this->cryptAes256->decryptMessage($message);
        $this->assertEquals('Test Message', $decrypt);
    }
}
