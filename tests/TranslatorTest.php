<?php

/**
 * This file is part of slick/i18n package
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Slick\Tests\I18n;

use Slick\Configuration\Configuration;
use Slick\I18n\TranslateMethods;
use Slick\I18n\Translator;

/**
 * Translator Test Case
 *
 * @package Slick\Tests\I18n
 * @author  Filipe Silva <silvam.filipe@gmail.com>
 */
class TranslatorTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Translate messages
     * @test
     */
    public function translateMessages()
    {
        Configuration::addPath(__DIR__);
        $translator = Translator::getInstance();
        $translator->getTranslatorService()
            ->addTranslationFile('phparray', __DIR__.'/messages.php');
        $myTranslator = new MyTranslator();
        $this->assertEquals('test', $myTranslator->translate('test'));
        $this->assertEquals('Olá mundo', $myTranslator->translate('Hello world'));
        $this->assertEquals('utilizador', $myTranslator->translatePlural('user', 'users', 1));
        $this->assertEquals('utilizadores', $myTranslator->translatePlural('user', 'users', 2));
        $translator->setLocale('pt_PT');
        $this->assertEquals('pt_PT', $translator->getConfiguration()->get('i18n.locale'));
    }
}

class MyTranslator
{
    use TranslateMethods;
}
