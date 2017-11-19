<?php

/**
 * This file is part of slick/i18n package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\I18n;

/**
 * Translation
 *
 * @package Slick\I18n
 */
class Translation
{

    const TYPE_PHP_ARRAY = 'phparray';
    const TYPE_GETTEXT   = 'gettext';

    /**
     * @var Language
     */
    private $language;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $domain;

    /**
     * @var string
     */
    private $type;

    /**
     * Creates a Translation
     *
     * @param Language $language
     * @param string   $path
     * @param string   $domain
     * @param string   $type
     */
    public function __construct(Language $language, $path, $domain = 'messages', $type = self::TYPE_PHP_ARRAY)
    {
        $this->language = $language;
        $this->path = $path;
        $this->domain = $domain;
        $this->type = $type;
    }

    /**
     * Translation messages path
     *
     * @return string
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * Translation language
     *
     * @return Language
     */
    public function language()
    {
        return $this->language;
    }

    /**
     * Translation domain
     *
     * @return string
     */
    public function domain()
    {
        return $this->domain;
    }

    /**
     * Translation type
     *
     * @return string
     */
    public function type()
    {
        return $this->type;
    }
}