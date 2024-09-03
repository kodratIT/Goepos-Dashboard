<?php

namespace App\Helpers;

use DateTime;
use DateTimeZone;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class HelpersUtils
{

    public static function convertTimestampToDate($timestamp)
    {
        try {
            return Carbon::parse($timestamp)
                ->setTimezone('Asia/Jakarta')  // Mengatur zona waktu ke UTC+7 (Jakarta)
                ->format('Y-m-d H:i');
        } catch (\Exception $e) {
            return '-';
        }
    }

    public static function convertTimestampToDateTrx($timestamp)
    {
        try {
            return Carbon::parse($timestamp)->format('Y-m-d H:i');
        } catch (\Exception $e) {
            return '-';
        }

    }

    public static function formatTimestamp($timestamp) {
        $seconds = $timestamp / 1000;
        $date = new DateTime("@$seconds");

        // return $date->format('d-m-Y H:i:s');
        return $date->format('d-m-Y');
    }

    public static function convertTimestamp($timestamp) {
        // Pastikan timestamp dalam milidetik dikonversi ke detik
        $timestampInSeconds = $timestamp / 1000;

        // Buat objek DateTime dari timestamp
        $dateTime = new DateTime("@$timestampInSeconds");

        // Tentukan timezone jika diperlukan, misalnya 'Asia/Jakarta'
        $dateTime->setTimezone(new DateTimeZone('Asia/Jakarta'));

        // Format tanggal sesuai keinginan
        return $dateTime->format('Y-m-d H:i');
    }

    public static function convertFirestoreTimestamp($timestamp) {
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

    public static function formatRupiah($value)
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
}
