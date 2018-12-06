<?php namespace Medology\Behat\Mink;

use Behat\Behat\Context\Context;
use Behat\Mink\Exception\DriverException;
use Behat\Mink\Exception\ExpectationException;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Medology\Behat\UsesStoreContext;
use Medology\SpinnerTimeoutException;
use ReflectionException;
use WebDriver\Exception;

class QualityAssurance implements Context
{
    use UsesFlexibleContext;
    use UsesStoreContext;

    /**
     * Asserts that a qaId is fully visible.
     *
     * @Then /^"(?P<qaId>[^"]+)" should(?P<not> not|) be fully visible$/
     *
     * @param  string                           $qaId The qaId of the dom element to find
     * @param  bool                             $not  Asserts qaId is partially or not visible in the viewport.
     * @throws DriverException                  When the operation cannot be done
     * @throws Exception                        If a webdriver error occurred.
     * @throws ExpectationException             If the page did not finish loading.
     * @throws ReflectionException              If injectStoredValues incorrectly believes one or more closures were
     *                                          passed. This should never happen. If it does, there is a problem with
     *                                          the injectStoredValues method.
     * @throws SpinnerTimeoutException          If the timeout expired before a single assertion could be made.
     * @throws UnsupportedDriverActionException When operation not supported by the driver
     */
    public function assertQaIDIsFullyVisible($qaId, $not = false)
    {
        $qaId = $this->storeContext->injectStoredValues($qaId);

        $this->flexibleContext->waitForPageLoad();

        $element = $this->flexibleContext->getSession()->getPage()->find('xpath', '//*[@data-qa-id="' . $qaId . '"]');
        if (!$element) {
            if ($not) {
                return;
            }

            throw new ExpectationException(
                "Data QA ID '$qaId' is not visible, but it should be",
                $this->flexibleContext->getSession()
            );
        }

        if ($not) {
            $this->flexibleContext->assertNodeIsNotFullyVisible($element);
        } else {
            $this->flexibleContext->assertNodeIsFullyVisible($element);
        }
    }
}
