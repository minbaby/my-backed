<?php


namespace App\IM\Handler;


use Hyperf\Constants\AbstractConstants;

/**
 * @Constants
 * @method static getMessage(int $code, $x = [])
 */
final class CodeEnum extends AbstractConstants
{
    /**
     * @Message("success")
     */
    const OP_SUCCESS = 0;

    /**
     * @Message("op not found")
     */
    const OP_NOT_FOUND = 20;

    /**
     * @Message("decode error")
     */
    const OP_DECODE_FAILED = 10;
}