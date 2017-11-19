<?php

/**
 * This file is part of slick/i18n package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\I18n;

use Slick\I18n\Exception\TranslatorNotSetException;

/**
 * Trait Translate Methods
 *
 * @package Slick\I18n
 */
trait TranslateMethods
{

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * Translate the provided message
     *
     * @param string $message
     *
     * @return string The translated message
     */
    public function translate($message)
    {
        $this->checkTranslator();
        return $this->translator->translate($message);
    }

    /**
     * Translates the provided message to singular or plural according to the number
     *
     * @param string  $singular
     * @param string  $plural
     * @param integer $number
     *
     * @return string
     */
    public function translatePlural($singular, $plural, $number)
    {
        $this->checkTranslator();
        return $this->translator->translatePlural($singular, $plural, $number);
    }

    /**
     * Checks if translate property is set
     */
    private function checkTranslator()
    {
        if (! $this->translator instanceof TranslatorInterface) {
            $name = __CLASS__;
            throw new TranslatorNotSetException(
                "The translator property was not set. Check that you have set the translator ".
                "property in {$name} class before using translate methods."
            );
        }
    }
}