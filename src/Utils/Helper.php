<?php

namespace App\Utils;

/**
 * Class Helper
 * @package App\Utils
 */
class Helper
{
    /**
     * @param int $length
     * @param bool $hasNumber
     * @param bool $hasUppercase
     * @param bool $hasLowercase
     * @return string
     */
    public static function randomStringGenerator(
        int $length = 10,
        bool $hasNumber = true,
        bool $hasUppercase = true,
        bool $hasLowercase = true
    ): string {
        $number = '0123456789';
        $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lowercase = 'abcdefghijklmnopqrstuvwxyz';

        $finalChoice = (($hasNumber) ? $number : '') . (($hasUppercase) ? $uppercase : '') . (($hasLowercase) ? $lowercase : '');
        return substr(str_shuffle($finalChoice), 0, $length);
    }
}