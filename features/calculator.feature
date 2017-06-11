Feature: Test calculator
  In order to test the correct behaviour of the calculator
  As a user
  I should perform all operations correctly

  Scenario: Sum two values
    Given I am in the calculator page
    When I enter 3 in the first field
    And I enter 5 in the second field
    And I select sum as the operation
    And I should see "Has escogido la operación +" in the popup
    And I confirm the popup
    And I click the button
    Then I should see 3 + 5 = 8
