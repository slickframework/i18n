# loading-multiple-translations.feature
  Feature: Loading multiple translations

    Scenario: Load pt_PT and fr_FR and translate both
      Given I set the translation to "pt_PT"
      And I add translation "fr_FR"
      When I try to translate "Hello"
      Then I should get "Olá"
      When I try to translate "Hello" to "fr_FR"
      Then I should get "Bonjour"