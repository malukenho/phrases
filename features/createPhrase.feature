Feature: Create phrase by post

  Scenario: Succesful create a new feature
    Given a phrase "Lorem Ipsum"
    And a title "Lorem"
    When I POST the phrase to "/"
    Then HTTP status code should be "201"
