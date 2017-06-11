Feature: Test calculator
  In order to test the correct behaviour of the calculator
  As a user
  I should perform all operations correctly

  Scenario: Sum two values
    Given I am on the homepage
    When I fill in the following:
      | x  | 3 |
      | y  | 5 |
      | op | + |
    And I should see "Has escogido la operación +" in the popup
    And I confirm the popup
    And I press "Calculate"
    Then I should see "3 + 5 = 8"
