<?php

function aes256Encrypt($text, $secretKey)
{
    $key = adjustKeyLength($secretKey); // Ensure the key is 32 bytes
    $iv = openssl_random_pseudo_bytes(16); // Generate a 16 bytes IV
    $cipher = 'aes-256-cbc';

    // Encrypt the text
    $encrypted = openssl_encrypt($text, $cipher, $key, OPENSSL_RAW_DATA, $iv);

    // Include the IV with the encrypted text
    $ivHex = bin2hex($iv);
    $encryptedHex = bin2hex($encrypted);

    return $ivHex . ':' . $encryptedHex;
}

function aes256Decrypt($encryptedText, $secretKey)
{
    list($ivHex, $encryptedHex) = explode(':', $encryptedText);
    $key = adjustKeyLength($secretKey); // Ensure the key is 32 bytes
    $iv = hex2bin($ivHex);
    $cipher = 'aes-256-cbc';

    // Decrypt the text
    $encrypted = hex2bin($encryptedHex);
    $decrypted = openssl_decrypt($encrypted, $cipher, $key, OPENSSL_RAW_DATA, $iv);

    return $decrypted;
}

// Fungsi untuk menyesuaikan panjang kunci
function adjustKeyLength($key)
{
    return hash('sha256', $key, true);
}
