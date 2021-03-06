Feature: Managing Ingredients
  In order to manage ingredients
  As a mixologist
  I must be able to

  Scenario: List ingredients
    When I execute use case "ListIngredients" with:
      | param | value |
    Then I should get a response "ListIngredients" with:
      | param | value |
      | count | 3     |
    And Items "ingredients" in response should have "name" values:
      | value |
      | rum   |
      | gin   |
      | vodka |

  Scenario: Create a particular ingredient
    When I execute use case "CreateIngredient" with:
      | param | value  |
      | name  | brandy |
    Then I should get a response "CreateIngredient" with:
      | param | value |
      | id    | 4     |

  Scenario: List added ingredient
    Given I execute use case "CreateIngredient" with:
      | param | value  |
      | name  | brandy |
    When I execute use case "ListIngredients" with:
      | param | value |
    Then I should get a response "ListIngredients" with:
      | param | value |
      | count | 4     |
    And Items "ingredients" in response should have "name" values:
      | value  |
      | rum    |
      | gin    |
      | vodka  |
      | brandy |
