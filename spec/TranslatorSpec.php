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
use Slick\I18n\Translator;
use PhpSpec\ObjectBehavior;
use Slick\I18n\TranslatorInterface;
use Zend\I18n\Translator\Translator as ZendTranslator;

/**
 * TranslatorSpec specs
 *
 * @package spec\Slick\I18n
 */
class TranslatorSpec extends ObjectBehavior
{

    /**
     * @var Translation
     */
    private $translation;

    private $language;

    function let(ZendTranslator $service)
    {
        $this->language = new Language('pt_PT');
        $this->translation = new Translation($this->language, __DIR__ . '/I18n');
        $service->addTranslationFilePattern(
            $this->translation->type(),
            $this->translation->path(),
            '%s/messages.php',
            $this->translation->domain()
        )->shouldBeCalled();

        $this->beConstructedWith($this->translation, $service);
    }

    function its_a_i18n_translator()
    {
        $this->shouldBeAnInstanceOf(TranslatorInterface::class);
    }

    function it_is_initializable_with_a_translation()
    {
        $this->shouldHaveType(Translator::class);
    }

    function it_has_a_translation_service(ZendTranslator $service)
    {
        $this->translationService()->shouldBe($service);
    }

    function it_has_a_current_language()
    {
        $this->currentLanguage()->shouldBe($this->language);
    }

    function it_has_a_default_domain()
    {
        $this->domain()->shouldBe('messages');
    }

    function it_translates_a_message(ZendTranslator $service)
    {

        $service->translate('hello', $this->translation->domain(), 'pt_PT')
            ->shouldBeCalled()
            ->willReturn('olá');

        $this->translate('hello')->shouldBe('olá');
    }

    function it_translates_plural_messages(ZendTranslator $service)
    {
        $service->translatePlural('user', 'users', 2,  $this->translation->domain(), 'pt_PT')
            ->shouldBeCalled()
            ->willReturn('utilizadores');

        $this->translatePlural('user', 'users', 2)->shouldBe('utilizadores');
    }
}