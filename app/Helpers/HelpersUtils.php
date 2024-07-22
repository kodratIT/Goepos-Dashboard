<?php

namespace App\Helpers;

use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class HelpersUtils
{

    public static function convertTimestampToDate($timestamp)
    {
        try {
            return Carbon::createFromTimestamp($timestamp)->format('d-m-Y H:i');
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

    public static function formatRupiah($value)
    {
        return 'Rp ' . number_format($value, 0, ',', '.');
    }
}
