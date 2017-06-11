<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Mink\Mink;
use Behat\Mink\Session;
use Behat\Mink\Driver\GoutteDriver;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    /**
     * @When I should see :arg1 in the popup
     */
    public function iShouldSeeInThePopup($arg1)
    {
        $alertText = $this->getSession()->getDriver()->getWebDriverSession()->getAlert_text();

        if ($alertText !=  $arg1) {
            throw new Exception('No text found in the alert');
        }
    }

    /**
     * @When I confirm the popup
     */
    public function iConfirmThePopup()
    {
        $this->getSession()->getDriver()->getWebDriverSession()->accept_alert();
    }

}
