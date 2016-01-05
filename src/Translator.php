<?php

/**
 * This file is part of slick/i18n package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\I18n;

use Slick\Common\BaseMethods;
use Slick\Configuration\Configuration;
use Slick\Configuration\ConfigurationInterface as DriverInterface;
use Zend\I18n\Translator\Translator as ZendTranslator;

/**
 * Translator (I18n)
 *
 * @package Slick\I18n
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 *
 * @property DriverInterface $configuration
 * @property ZendTranslator  $translatorService
 *
 * @property string $type
 * @property string $basePath
 * @property string $domain
 * @property string $fallbackLocale
 */
class Translator
{
    /**
     * @readwrite
     * @var ZendTranslator
     */
    protected $translatorService;

    /**
     * @readwrite
     * @var DriverInterface
     */
    protected $configuration;

    /**
     * @readwrite
     * @var string The message domain
     */
    protected $domain = 'default';

    /**
     * @readwrite
     * @var string Default fallback locale
     */
    protected $fallbackLocale = 'en_US';

    /**
     * @readwrite
     * @var string
     */
    protected $basePath = './I18n';

    /**
     * @readwrite
     * @var string
     */
    protected $type = 'gettext';

    /**
     * @var array
     */
    private $types = [
        'gettext' => '.mo',
        'phparray' => '.php'
    ];

    /**
     * @var Translator
     */
    private static $instance;

    /**
     * Trait with method for base class
     */
    use BaseMethods;

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     *
     * @param array $options A list of properties for this connector
     */
    protected function __construct($options = array())
    {
        $this->hydrate($options);
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @codeCoverageIgnore
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @codeCoverageIgnore
     * @SuppressWarnings(PHPMD.UnusedPrivateMethod)
     * @return void
     */
    private function __wakeup()
    {
    }

    /**
     * Lazy loads configuration
     *
     * @return DriverInterface
     */
    public function getConfiguration()
    {
        if (is_null($this->configuration)) {
            $this->configuration = Configuration::get('config');
        }
        return $this->configuration;
    }

    /**
     * Lazy loads zend translator
     *
     * @return ZendTranslator
     */
    public function getTranslatorService()
    {
        if (is_null($this->translatorService)) {
            $translator = new ZendTranslator();
            $translator->addTranslationFilePattern(
                $this->type,
                $this->basePath,
                '%s/'.$this->getMessageFile(),
                $this->domain
            );
            $this->translatorService = $translator;
        }
        return $this->translatorService;
    }

    /**
     * Returns the messages file name based on domain
     *
     * @return string
     */
    public function getMessageFile()
    {
        $name = $this->domain;
        $name .= $this->types[$this->type];
        return $name;
    }

    /**
     * Returns the translation for the provided message
     *
     * @param string $message
     *
     * @return string
     */
    public function translate($message)
    {
        return $this->getTranslatorService()
            ->translate($message, $this->domain, $this->getLocale());
    }

    /**
     * Translate a plural message.
     *
     * @param  string $singular
     * @param  string $plural
     * @param  int    $number
     *
     * @return string
     */
    public function translatePlural($singular, $plural, $number)
    {
        return $this->getTranslatorService()
            ->translatePlural(
                $singular,
                $plural,
                $number,
                $this->domain,
                $this->getLocale()
            );
    }

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @param array $options The list of property values of this instance.
     *
     * @return Translator The *Singleton* instance.
     */
    public static function getInstance($options = array())
    {
        if (is_null(self::$instance)) {
            self::$instance = new Translator($options);
        }
        return self::$instance;
    }

    /**
     * Sets locale
     *
     * @param $locale
     *
     * @returns Translator
     */
    public function setLocale($locale)
    {
        $this->getConfiguration()->set('i18n.locale', $locale);
        return $this;
    }

    /**
     * Gets current configured locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->configuration->
        get('i18n.locale', $this->fallbackLocale);
    }
}
