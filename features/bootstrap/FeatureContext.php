<?php

use Behat\Behat\Context\Context;
use Slick\I18n\Language;
use Slick\I18n\Translator;
use Slick\I18n\Translation;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    private $translations = [];

    /** @var  Translator */
    private $translator;

    private $translatedMessage;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->translations['pt_PT'] = new Translation(new Language('pt_PT'), __DIR__.'/i18n');
        $this->translations['fr_FR'] = new Translation(new Language('fr_FR'), __DIR__.'/i18n');
    }

    /**
     * @Given I set the translation to :language
     * @param string $language
     */
    public function iSetTheTranslationTo($language)
    {
        $this->translator = new Translator($this->translations[$language]);
    }

    /**
     * @When I try to translate :message
     * @param string $message
     */
    public function iTryToTranslate($message)
    {
        $this->translatedMessage = $this->translator->translate($message);
    }

    /**
     * @Then I should get :translatedMessage
     * @param string $translatedMessage
     *
     * @throws Exception
     */
    public function iShouldGet($translatedMessage)
    {
        if ($this->translatedMessage !== $translatedMessage) {
            throw new Exception("Expected '{$translatedMessage}' from translation, but got '{$this->translatedMessage}'...");
        }
    }

    /**
     * @When I try to translate plural of :singular given :number :plural
     * @param $singular
     * @param $number
     * @param $plural
     */
    public function iTryToTranslatePluralOfGiven($singular, $number, $plural)
    {
        $this->translatedMessage = $this->translator->translatePlural($singular, $plural, $number);
    }

    /**
     * @Given I add translation :locate
     * @param string $locale
     */
    public function iAddTranslation($locale)
    {
        $this->translator->addTranslation($this->translations[$locale]);
    }

    /**
     * @When I try to translate :message to :locale
     * @param $message
     * @param $locale
     */
    public function iTryToTranslateTo($message, $locale)
    {
        $this->translatedMessage = $this->translator->translate($message, 'messages', $locale);
    }
}
