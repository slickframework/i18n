<?php

/**
 * This file is part of slick/i18n package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\I18n;

/**
 * Translation Capable Interface
 *
 * @package Slick\I18n
 */
interface TranslationCapableInterface
{

    /**
     * Translate the provided message
     *
     * @param string $message
     *
     * @return string The translated message
     */
    public function translate($message);

    /**
     * Translates the provided message to singular or plural according to the number
     *
     * @param string  $singular
     * @param string  $plural
     * @param integer $number
     *
     * @return mixed
     */
    public function translatePlural($singular, $plural, $number);
}
