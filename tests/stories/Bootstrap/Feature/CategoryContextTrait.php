<?php

namespace Whizz\Test\Stories\Gallery\Bootstrap\Feature;

use Behat\Behat\Hook\Scope\AfterScenarioScope;

trait CategoryContextTrait
{

    /**
     * @AfterScenario @categories
     */

    function afterCategories(AfterScenarioScope $scope)
    {
        $this->readModelPdoConnection->getConnection()->exec("TRUNCATE TABLE categories");
    }
}