<?php
declare(strict_types=1);

namespace Samius;


class Strings
{
    public const CHARS_LOWER = 1,
        CHARS_UPPER = 2,
        CHARS_NUMERIC = 4,
        CHARS_SPECIAL = 8;

    /**
     * Generates random string with given lenght
     * You can determine which characters the string is generated of with $type
     * @param int $length
     * @param int $type - list of character classes, divided with bitwise OR. e.g. Strings::CHAR_LOWER|Strings::CHAR_UPPER|Strings::NUMERIC
     * @return string
     */
    public static function generateRandomString(int $length, int $type = self::CHARS_LOWER): string
    {
        $chars = [];
        if (($type & self::CHARS_LOWER) === self::CHARS_LOWER) {
            $chars = array_merge($chars, range('a', 'z'));
        }
        if (($type & self::CHARS_UPPER) === self::CHARS_UPPER) {
            $chars = array_merge($chars, range('A', 'Z'));
        }
        if (($type & self::CHARS_NUMERIC) === self::CHARS_NUMERIC) {
            $chars = array_merge($chars, range('0', '9'));
        }
        if (($type & self::CHARS_SPECIAL) === self::CHARS_SPECIAL) {
            $chars = array_merge($chars, ['!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '[', ']', '{', '}']);
        }

        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $chars[rand(0, \count($chars) - 1)];
        }

        return $randstring;
    }

    /**
     * Removes diacritics from UTF8 string.
     * e.g. 'příliš žluťoučký kůň úpěl ďábelské ódy' converts to 'prilis zlutoucky kun upel dabelske ody'
     * @param string $text
     * @return string
     */
    public static function removeDiacritics(string $text):string
    {
        $transliterator = \Transliterator::create('NFD; [:Nonspacing Mark:] Remove; NFC;');
        return $transliterator->transliterate($text);
    }

    /**
     * Returns classic lorem ipsum text. If longer text is needed, just increase the multiplier
     * @param int $multiplier
     * @return string
     */
    public static function lipsum(int $multiplier = 1)
    {
        $base = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
        $res = '';
        for ($i = 0; $i < $multiplier; $i++) {
            $res .= $base;
        }

        return $res;
    }
}