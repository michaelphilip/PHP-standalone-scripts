<?php
class Crypt 
{
    public function __construct()
    {
        if (function_exists('openssl_encrypt')) {
            $textToEncrypt = "This is my information";
            $encryptionMethod = "AES-256-CBC";  // AES is used by the U.S. gov't to encrypt top secret documents.
            $secretKey = "25c6c7ff35b9979b151f2136cd13b0ff"; //32 chars
        	$iv = 'aoe92js74ekke22s'; //16 chars
        	
        	$delimiter = '|';
        	$ramdomSeedLen = 10;
        	$omitLen = $ramdomSeedLen + strlen($delimiter);
        	
        	$seedA = self::generateRandomNumber(10);
        	$seedB = self::generateRandomNumber(10);
        	$text = $seedA . $delimiter . $textToEncrypt . $delimiter . $seedB;
            //To encrypt
            $encryptedMessage = base64_encode(openssl_encrypt($text, $encryptionMethod, $secretKey, false, $iv));
            
            //To Decrypt
            $encryptedMessage = base64_decode($encryptedMessage);
            $decryptedMessage = openssl_decrypt($encryptedMessage, $encryptionMethod, $secretKey, false, $iv);
            $decryptedMessage = substr($decryptedMessage, $omitLen, strlen($decryptedMessage) - (2 * $omitLen));
            
            //Result
            echo "Encrypted: $encryptedMessage <br/><br/> Decrypted: $decryptedMessage";
        }
    }

    public static function generateRandomNumber($length)
    {
        $num = null;
        for ($i = 0; $i < $length; $i++) $num .= mt_rand(0, 9);
        return $num;
    }
}
