<?php

namespace App\Utils;

class MemUtils
{
    public static function mem(): string
    {
        return
            sprintf(
                "%s/%s, %s/%s",
                static::formatBytes(memory_get_usage()),
                static::formatBytes(memory_get_usage(true)),
                static::formatBytes(memory_get_peak_usage()),
                static::formatBytes(memory_get_peak_usage(true))
            );
    }

    public static function formatBytes($bytes): string
    {
        $bytes = (int)$bytes;

        if ($bytes > 1024 * 1024) {
            return round($bytes / 1024 / 1024, 2) . ' MB';
        } elseif ($bytes > 1024) {
            return round($bytes / 1024, 2) . ' KB';
        }

        return $bytes . ' B';
    }
}