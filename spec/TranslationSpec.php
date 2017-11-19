<?php

/**
 * This file is part of slick/i18n package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Slick\I18n;

use Slick\I18n\Language;
use Slick\I18n\Translation;
use PhpSpec\ObjectBehavior;

/**
 * TranslationSpec specs
 *
 * @package spec\Slick\I18n
 */
class TranslationSpec extends ObjectBehavior
{
    private $language;

    private $path = __DIR__ . '/I18n';

    function let()
    {
        $this->language = new Language('en_US');
        $this->beConstructedWith($this->language, $this->path);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Translation::class);
    }

    function it_has_a_path()
    {
        $this->path()->shouldBe($this->path);
    }

    function it_has_a_language()
    {
        $this->language()->shouldBe($this->language);
    }

    function it_has_a_domain()
    {
        $this->domain()->shouldBe('messages');
    }

    function it_has_a_type()
    {
        $this->type()->shouldBe(Translation::TYPE_PHP_ARRAY);
    }
}