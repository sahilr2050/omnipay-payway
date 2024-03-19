<?php
/** Uuid Helper class */

namespace Omnipay\PaywayRest\Helper;

/**
 *
 */
abstract class Uuid
{

    /**
     * Create a UUID v4 string enclosed by braces
     * @return string UUID v4 string with braces
     */
    public static function createEnclosed(): string
    {
        return '{' . self::create() . '}';
    }

    /**
     * Create UUID v4 string
     *
     * Inspiration from GUI: the guid generator
     * @see http://guid.us/GUID/PHP
     *
     * @return string UUID v4 as string
     */
    public static function create(): string
    {
        // use COM helper if available
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        }

        // generate UUID
        mt_srand((double)microtime() * 10000); // optional for php 4.2.0 and up.
        $charId = strtoupper(md5(uniqid(mt_rand(), true)));
        return implode('-', array(
            substr($charId, 0, 8),
            substr($charId, 8, 4),
            substr($charId, 12, 4),
            substr($charId, 16, 4),
            substr($charId, 20, 12),
        ));
    }
}
