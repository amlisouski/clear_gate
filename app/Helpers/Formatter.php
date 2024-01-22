<?php

namespace App\Helpers;

use App\Models\Site;
use Carbon\Carbon;

class Formatter
{
    public static function MoneyToDB($sum, $default = 0): float
    {
        $sum = $sum ? str_replace(',', '', $sum) : $default;
        return number_format((float)$sum, 2, '.', '');
    }

    public static function MoneyToString($amount, $currency_before = '$', $currency_after = ''): string
    {
        return $currency_before . number_format($amount, 2, '.', '') . $currency_after;
    }

    public static function EmailToString($phone = false): string
    {
        if ($phone) {
            return '<a class="link-success" href="mailto:' . $phone . '">' . $phone . '</a>';
        } else {
            return '<span class="accent-gray-600">none</span>';
        }
    }

    public static function PhoneToString($phone = false): string
    {
        if ($phone) {
            return '<a class="link-success" href="tel:' . $phone . '">' . $phone . '</a>';
        } else {
            return '<span class="accent-gray-600">none</span>';
        }
    }

    public static function formatDate($datetime): string
    {
        return $datetime ? Carbon::parse($datetime)->format('m/d/Y') : 'none';
    }

    public static function formatDateForForm($datetime): string
    {
        return $datetime ? Carbon::parse($datetime)->toDateString() : '';
    }

    public static function formatTime($datetime): string
    {
        return $datetime ? Carbon::parse($datetime)->format('H:i:s') : 'none';
    }

    public static function formatDateTime($datetime): string
    {
        return $datetime ? Carbon::parse($datetime)->format('m/d/Y H:i:s') : 'none';
    }

    public static function formatDateTimeForForm($datetime): string
    {
        return $datetime ? Carbon::parse($datetime)->toDateTimeString() : '';
    }

    public static function colorize_notice_proceed($status): string
    {
        $color = match ($status) {
            Site::NOTICE_PROCEED_STATUS_NONE => 'danger',
            Site::NOTICE_PROCEED_STATUS_REQUESTED => 'warning',
            Site::NOTICE_PROCEED_STATUS_RECEIVED => 'success',
            default => 'primary',
        };
        return '<span class="text-uppercase text-' . $color . '">' . $status . '</span>';
    }

    public static function human_filesize($bytes, $decimals = 2): string
    {
        $factor = floor((strlen($bytes) - 1) / 3);
        if ($factor > 0) $sz = 'KMGT';
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor - 1] . 'B';
    }
}
