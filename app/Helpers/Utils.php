<?php

use Carbon\Carbon;

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


function convertIsoToCustomDate($isoDate, $timezone = 'Asia/Jakarta')
{
    // Mengubah ISO 8601 date menjadi objek Carbon dan menetapkan timezone Jakarta
    $date = Carbon::parse($isoDate)->setTimezone($timezone);

    // Mengembalikan dalam format yang diinginkan, misalnya 'Y-m-d H:i:s'
    return $date->format('Y-m-d H:i:s');
}

function convertTimestampToDate($timestamp) {
    // Konversi _seconds dan _nanoseconds menjadi detik penuh
    // dd($timestamp);
    $seconds = $timestamp->_seconds;
    $nanoseconds = $timestamp->_nanoseconds;

    // Buat objek DateTime dari timestamp
    $dateTime = new DateTime("@$seconds");

    // Tentukan timezone jika diperlukan, misalnya 'Asia/Jakarta'
    $dateTime->setTimezone(new DateTimeZone('Asia/Jakarta'));

    // Format tanggal sesuai keinginan
    return $dateTime->format('Y-m-d H:i');
}

