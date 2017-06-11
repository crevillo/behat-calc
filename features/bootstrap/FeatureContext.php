<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Mink\Mink;
use Behat\Mink\Session;
use Behat\Mink\Driver\GoutteDriver;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    protected $mink;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->mink = new Mink(array(
            'selenium2' => new Session(new \Behat\Mink\Driver\Selenium2Driver(
                'chrome'
            )),
        ));
    }

    private function getSession()
    {
        return $this->mink->getSession('selenium2');
    }

    /**
     * @Given I am in the calculator page
     */
    public function iAmInTheCalculatorPage()
    {
        $this->getSession()->visit('http://calculator');
    }

    /**
     * @When I enter :arg1 in the first field
     */
    public function iEnterInTheFirstField($arg1)
    {
        $page = $this->getSession()->getPage();
        $page->fillField('x', $arg1);
        sleep(1);
    }

    /**
     * @When I enter :arg1 in the second field
     */
    public function iEnterInTheSecondField($arg1)
    {
        $page = $this->getSession()->getPage();
        $page->fillField('y', $arg1);
        sleep(1);
    }

    /**
     * @When I select sum as the operation
     */
    public function iSelectSumAsTheOperation()
    {
        $page = $this->getSession()->getPage();
        $page->selectFieldOption('op', '+');
        sleep(1);
    }

    /**
     * @When I click the button
     */
    public function iClickTheButton()
    {
        $page = $this->getSession()->getPage();
        $page->pressButton('calc');
        sleep(1);
    }

    /**
     * @Then I should see :arg1 + :arg2 = :arg3
     */
    public function iShouldSee($arg1, $arg2, $arg3)
    {
        $page = $this->getSession()->getPage();
        if (!$page->hasContent("$arg1 + $arg2 = $arg3")) {
            throw new \Exception('Content not found in page');
        }
    }

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
