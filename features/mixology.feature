Feature: Managing Ingredients
  In order to manage ingredients
  As a mixologist
  I must be able to

  Scenario: List ingredients
      Given I have use case "ListIngredients"
      And I have request "ListIngredients" with:
        |param | value|
      When I execute use case
      Then I should get a response "ListIngredients" with:
        | param | value |
        | count | 3     |
      And Items "ingredients" in response should have "name" values:
        |value |
        |rum   |
        |gin   |
        |vodka |

  Scenario: Create a particular ingredient
    Given I have use case "CreateIngredient"
    And I have request "CreateIngredient" with:
      |param | value  |
      |name  | brandy |
    When I execute use case
    Then I should get a response "CreateIngredient" with:
      |param | value|
      |id    | 4    |

  Scenario: List added ingredient
    Given I have use case "CreateIngredient"
    And I have request "CreateIngredient" with:
      |param | value  |
      |name  | brandy |
    And I execute use case
    And I have use case "ListIngredients"
    And I have request "ListIngredients" with:
      |param | value|
    When I execute use case
    Then I should get a response "ListIngredients" with:
      | param | value |
      | count | 4     |
    And Items "ingredients" in response should have "name" values:
      |value |
      |rum   |
      |gin   |
      |vodka |
      |brandy|
