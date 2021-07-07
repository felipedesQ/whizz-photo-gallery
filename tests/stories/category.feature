Feature: Category

  @categories
  Scenario: I receive a category post
    Given I find 0 "CategoryEntity" entities
    When I send a POST request to "add-category" with body:
    """
    {
      "name": "Category 1"
    }
    """
    Then the response status code should be 200
    And I find 1 "CategoryEntity" entities
    And I find a "CategoryEntity" entity with "name" "Category 1"