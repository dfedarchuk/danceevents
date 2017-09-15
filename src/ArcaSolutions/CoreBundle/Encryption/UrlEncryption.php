<?php


namespace ArcaSolutions\CoreBundle\Encryption;

class UrlEncryption
{
    private $secret;
    private $iv;

    public function __construct($secret)
    {
        $this->secret = $this->validateSecret($secret);
        $mod = mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_ECB, '');
        $this->iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($mod), MCRYPT_RAND);
    }

    public function encrypt($plainText)
    {
        $encrypted = mcrypt_encrypt(MCRYPT_3DES, $this->secret, $plainText, MCRYPT_MODE_ECB, $this->iv);

        return $this->base64UrlEncode($encrypted);
    }

    public function decrypt($encrypted)
    {

        $decrypted = mcrypt_decrypt(MCRYPT_3DES, $this->secret, $this->base64UrlDecode($encrypted), MCRYPT_MODE_ECB, $this->iv);

        return trim($decrypted);
    }

    private function base64UrlEncode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64UrlDecode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    private function validateSecret($secret)
    {
        if (mb_strlen($secret) > 24 ) {
            return mb_substr($secret, 0, 24);
        }

        return $secret;
    }
}