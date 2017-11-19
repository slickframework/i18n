# message translation
  Feature: Message translation
    In order to translate a message
    as a developer
    I want to set a translation and retrieve a translated message

  Scenario: simple message
    Given I set the translation to "pt_PT"
    When I try to translate "Hello"
    Then I should get "Olá"

  Scenario: massage not found
    Given I set the translation to "pt_PT"
    When I try to translate "Test"
    Then I should get "Test"