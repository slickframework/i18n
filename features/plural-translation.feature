# plural-translation.feature
  Feature: Plural translation
    In order to translate messages in the plural
    as a developer
    I want to set a translation and retrieve a translated message in the plural

  Scenario: plural translation
    Given I set the translation to "pt_PT"
    When I try to translate plural of "User" given 2 "Users"
    Then I should get "Utilizadores"