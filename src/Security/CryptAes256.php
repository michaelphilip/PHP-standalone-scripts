<?php

namespace Standalone\Security;

use Exception;

final class CryptAes256
{
    /**
     * string | AES is used by the U.S. gov't to encrypt top secret documents.
     */
    private $encryptionMethod = 'AES-256-CBC';

    /**
     * @var string
     */
    private $delimiter = '|';

    /**
     * @var int
     */
    private $seedLength = 10;

    /**
     * @var string|string 32 chars
     */
    private $secretKey = '25c6c7ff35b9979b151f2136cd13b0ff';

    /**
     * @var string | 16 chars
     */
    private $ivKey = 'aoe92js74ekke22s';

    public function __construct(string $secretKey, string $ivKey)
    {
        if (!function_exists('openssl_encrypt')) {
            throw new Exception('openssl_encrypt does not exist.');
        }

        if ($secretKey) {
            $this->secretKey = $secretKey;
        }

        if ($ivKey) {
            $this->ivKey = $ivKey;
        }
    }

    /**
     * In case it uses openssl_random_pseudo_bytes you need to modify this code to store your iv somewhere
     * because you need it later for decryption
     *
     * @param string $textToEncrypt
     *
     * @return string
     */
    public function encryptMessage(string $textToEncrypt): string
    {
        $seedA = $this->generateRandomNumber($this->seedLength);
        $seedB = $this->generateRandomNumber($this->seedLength);
        $text = $seedA . $this->delimiter . $textToEncrypt . $this->delimiter . $seedB;

        return base64_encode(openssl_encrypt(
            $text,
            $this->encryptionMethod,
            $this->secretKey,
            false,
            $this->ivKey ?: openssl_random_pseudo_bytes(16)
        ));
    }

    /**
     * @param $textToDecrypt
     *
     * @return bool|string
     */
    public function decryptMessage(string $textToDecrypt): string
    {
        $text = base64_decode($textToDecrypt);
        $decryptedMessage = openssl_decrypt(
            $text,
            $this->encryptionMethod,
            $this->secretKey,
            false,
            $this->ivKey
        );
        $omitLen = $this->seedLength + strlen($this->delimiter);

        return substr($decryptedMessage, $omitLen, strlen($decryptedMessage) - (2 * $omitLen));
    }

    /**
     * @param $length
     *
     * @return null|string
     */
    private function generateRandomNumber(int $length): string
    {
        $num = null;
        for ($i = 0; $i < $length; $i++) {
            $num .= mt_rand(0, 9);
        }
        return $num;
    }
}
