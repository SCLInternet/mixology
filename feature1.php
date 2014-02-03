   /**
     * @Given /^there is something$/
     */
    public function thereIsSomething()
    {
	echo "there IsSomething";
        throw new PendingException();
    }

    /**
     * @When /^I do something$/
     */
    public function iDoSomething()
    {
	echo "iDoSomething";
        throw new PendingException();
    }

    /**
     * @Then /^I should see something$/
     */
    public function iShouldSeeSomething()
    {
	echo "iShouldSeeSomething";
        throw new PendingException();
    }
