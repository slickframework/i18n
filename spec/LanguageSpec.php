<?php

/**
 * This file is part of slick/i18n package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\Slick\I18n;

use Slick\I18n\Language;
use PhpSpec\ObjectBehavior;

/**
 * LanguageSpec specs
 *
 * @package spec\Slick\I18n
 */
class LanguageSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('pt-PT');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Language::class);
    }

    function it_can_be_printed_out_as_text()
    {
        $this->__toString()->shouldBe('pt_PT');
    }

    function it_has_a_language_name()
    {
        $this->language()->shouldBe('Portuguese');
    }

    function it_has_a_language_code()
    {
        $this->languageCode()->shouldBe('pt');
    }

    function it_has_a_region_name()
    {
        $this->regionName()->shouldBe('Portugal');
    }

    function it_has_a_region_code()
    {
        $this->regionCode()->shouldBe('PT');
    }

    function it_has_a_rfc_3066_language_identifier()
    {
        $this->identifier()->shouldBe('pt_PT');
    }
}