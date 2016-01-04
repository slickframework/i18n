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
    protected $_translatorService;

    /**
     * @readwrite
     * @var DriverInterface
     */
    protected $_configuration;

    /**
     * @readwrite
     * @var string The message domain
     */
    protected $_domain = 'default';

    /**
     * @readwrite
     * @var string Default fallback locale
     */
    protected $_fallbackLocale = 'en_US';

    /**
     * @readwrite
     * @var string
     */
    protected $_basePath = './I18n';

    /**
     * @readwrite
     * @var string
     */
    protected $_type = 'gettext';

    /**
     * @var array
     */
    private $_types = [
        'gettext' => '.mo',
        'phparray' => '.php'
    ];

    /**
     * @var Translator
     */
    private static $_instance;

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
        if (is_null($this->_configuration)) {
            $this->_configuration = Configuration::get('config');
        }
        return $this->_configuration;
    }

    /**
     * Lazy loads zend translator
     *
     * @return ZendTranslator
     */
    public function getTranslatorService()
    {
        if (is_null($this->_translatorService)) {
            $translator = new ZendTranslator();
            $translator->addTranslationFilePattern(
                $this->type,
                $this->basePath,
                '%s/'.$this->getMessageFile(),
                $this->domain
            );
            $this->_translatorService = $translator;
        }
        return $this->_translatorService;
    }

    /**
     * Returns the messages file name based on domain
     *
     * @return string
     */
    public function getMessageFile()
    {
        $name = $this->domain;
        $name .= $this->_types[$this->type];
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
        $locale = $this->configuration
            ->get('i18n.locale', $this->fallbackLocale);
        return $this->getTranslatorService()
            ->translate($message, $this->domain, $locale);
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
        $locale = $this->configuration->
        get('i18n.locale', $this->fallbackLocale);
        return $this->getTranslatorService()
            ->translatePlural(
                $singular,
                $plural,
                $number,
                $this->domain,
                $locale
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
        if (is_null(static::$_instance)) {
            static::$_instance = new Translator($options);
        }
        return static::$_instance;
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
}
