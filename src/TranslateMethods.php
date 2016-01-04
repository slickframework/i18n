<?php

/**
 * This file is part of slick/I18n package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\I18n;


/**
 * Translate methods (I18n)
 *
 * @package Slick\I18n
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
trait TranslateMethods
{
    /**
     * Returns the translation for the provided message
     *
     * @param string $message
     *
     * @return string
     */
    public function translate($message)
    {
        return Translator::getInstance()->translate($message);
    }

    /**
     * Translate a plural message.
     *
     * @param string $singular
     * @param string $plural
     * @param int    $number
     *
     * @return string
     */
    public function translatePlural($singular, $plural, $number)
    {
        return Translator::getInstance()
            ->translatePlural($singular, $plural, $number);
    }
}
