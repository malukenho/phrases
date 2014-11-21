Feature: Interact with phrase main resource
  to get any phrase provide by application

  Scenario: Getting a Phrase
    Given a new Request object
    And this object need a specific application/json Accept HTTP header
    When I access the page
    Then I get a phrase in json format
