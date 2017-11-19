<?php

/**
 * This file is part of slick/i18n package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\I18n;

use Zend\I18n\Translator\Translator as ZendTranslator;

/**
 * Translator
 *
 * @package Slick\I18n
 */
class Translator implements TranslatorInterface
{
    /**
     * @var Translation[]
     */
    private $translations = [];

    /**
     * @var TranslatorInterface|ZendTranslator
     */
    private $service;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var Language
     */
    private $currentLanguage;

    /**
     * @var array
     */
    private $types = [
        Translation::TYPE_GETTEXT   => '.mo',
        Translation::TYPE_PHP_ARRAY => '.php'
    ];

    /**
     * Translator constructor.
     * @param Translation $translation
     * @param ZendTranslator|null $service
     */
    public function __construct(Translation $translation, ZendTranslator $service = null)
    {
        $this->service = ( null == $service) ? new ZendTranslator() : $service;

        $this->currentLanguage = $translation->language();
        $this->domain = $translation->domain();

        $this->addTranslation($translation);
    }

    /**
     * The translation service
     *
     * @return ZendTranslator
     */
    public function translationService()
    {
        return $this->service;
    }

    /**
     * The current default language
     *
     * @return Language
     */
    public function currentLanguage()
    {
        return $this->currentLanguage;
    }

    /**
     * Current default domain
     *
     * @return string
     */
    public function domain()
    {
        return $this->domain;
    }

    /**
     * Translate a message.
     *
     * @param  string $message
     * @param  string $textDomain
     * @param  string $locale
     * @return string
     */
    public function translate($message, $textDomain = 'default', $locale = null)
    {
        $textDomain = $textDomain !== 'default' ? $textDomain : $this->domain();
        $locale = $locale ?: (string) $this->currentLanguage();

        return $this->translationService()->translate($message, $textDomain, $locale);
    }

    /**
     * Translate a plural message.
     *
     * @param  string $singular
     * @param  string $plural
     * @param  int $number
     * @param  string $textDomain
     * @param  string|null $locale
     * @return string
     */
    public function translatePlural(
        $singular,
        $plural,
        $number,
        $textDomain = 'default',
        $locale = null
    )
    {
        $textDomain = $textDomain !== 'default' ? $textDomain : $this->domain();
        $locale = $locale ?: (string) $this->currentLanguage();

        return $this->translationService()->translatePlural($singular, $plural, $number, $textDomain, $locale);
    }

    /**
     * Adds a translation to the translator
     *
     * @param Translation $translation
     *
     * @return self|Translator
     */
    public function addTranslation(Translation $translation)
    {
        $key = "{$translation->language()}::{$translation->domain()}";
        $name = "{$translation->domain()}{$this->types[$translation->type()]}";
        $this->translationService()
            ->addTranslationFilePattern(
                $translation->type(),
                $translation->path(),
                "%s/{$name}",
                $translation->domain()
            );
        $this->translations[$key] = $translation;
        return $this;
    }

}
