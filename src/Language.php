<?php

/**
 * This file is part of slick/i18n package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\I18n;

use Slick\I18n\Exception\UnknownLanguageCodeException;

/**
 * Language
 *
 * @package Slick\I18n
 */
final class Language
{

    private static $codes;

    /**
     * @var string
     */
    private $language;

    /**
     * @var string
     */
    private $languageCode;

    /**
     * @var string
     */
    private $regionName;

    /**
     * @var string
     */
    private $regionCode;

    /**
     * Language
     *
     * @param string $code
     */
    public function __construct($code)
    {
        list($langCode, $langName) = self::parseLanguage($code);
        list($regCode, $regName) = self::parseRegion($code);
        $this->language = $langName;
        $this->languageCode = $langCode;
        $this->regionCode = $regCode;
        $this->regionName = $this->clear($regName);
    }

    /**
     * @inheritdoc
     */
    public function __toString()
    {
        return $this->identifier();
    }

    /**
     * Get language name
     *
     * @return string
     */
    public function language()
    {
        return $this->language;
    }

    /**
     * Get ISO 639-1 2 letter language code
     *
     * @return string
     */
    public function languageCode()
    {
        return $this->languageCode;
    }

    /**
     * Get region name
     *
     * @return mixed
     */
    public function regionName()
    {
        return $this->regionName;
    }

    /**
     * Get region 2 letter country code
     *
     * @return string
     */
    public function regionCode()
    {
        return $this->regionCode;
    }

    /**
     * Clears the name of passed region
     *
     * @param string $regName
     *
     * @return string
     */
    private function clear($regName)
    {
        $name = str_replace(
            [$this->language(), '(', ')'],
            '',
            $regName
        );
        return trim($name);
    }

    /**
     * Get language code
     *
     * @param string $code
     *
     * @return array
     */
    private static function parseLanguage($code)
    {
        $lang = substr($code, 0, 2);
        foreach (self::codes() as $code) {
            if ($code['code'] == strtolower($lang)) {
                return [strtolower($lang), $code['description']];
            }
        }

        throw new UnknownLanguageCodeException(
            "The language code '{$code}'' is unknown."
        );
    }

    /**
     * Get regina name and code
     *
     * @param string $code
     *
     * @return array
     */
    private static function parseRegion($code)
    {
        $lang = substr($code, 0, 2);
        $reg =  strtoupper(substr($code, 3, 2));
        $needle = "{$lang}-{$reg}";
        foreach (self::codes() as $code) {
            if ($code['code'] == $needle) {
                return [$reg, $code['description']];
            }
        }

        throw new UnknownLanguageCodeException(
            "The region code '{$code}'' is unknown."
        );
    }

    /**
     * Language database
     *
     * @return array
     */
    private static function codes()
    {
        if (!self::$codes) {
            self::$codes = include 'language-db.php';
        }
        return self::$codes;
    }

    /**
     * Get the language RFC 3066 identifier
     *
     * @return string
     */
    public function identifier()
    {
        return "{$this->languageCode()}_{$this->regionCode()}";
    }
}