<?php


namespace App\Utils;


class ChatUtils
{
    const MESSAGE_STORE = 'store';

    const MESSAGE_PUSH = 'push';

    const SESSION_PREFIX = 'session';

    /**
     * @param string $from
     * @param string $to
     * @return string
     */
    public static function sessionId(string $from, string $to): string
    {
        $format = static::SESSION_PREFIX . ":%s:%s";
        if ($from >= $to) {
            return sprintf($format, $from, $to);
        }

        return sprintf($format, $to, $from);
    }

    public static function isOnline(string $uid)
    {
        return false;
    }
}