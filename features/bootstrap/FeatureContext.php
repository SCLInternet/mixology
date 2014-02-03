<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Play\Ingredient;
use Play\MockDB\MockRepositoryFactory;
use Play\UseCase\UseCaseFactory;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    private $usecaseFactory;
    private $usecase;
    private $request;
    private $response;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->usecaseFactory = new UseCaseFactory(new MockRepositoryFactory());
        // Initialize your context here
    }
    /**
     * @Given /^I have use case "([^"]*)"$/
     */
    public function iHaveUseCase($name)
    {
        $this->usecase = $this->usecaseFactory->create($name);
    }

    /**
     * @Given /^I have request "([^"]*)" with:$/
     */
    public function iHaveRequestWith($name, TableNode $params)
    {
        $fqcn = $this->buildUseCaseClassName($name, 'Request');

        $args = [];

        foreach ($params->getHash() as $p) {
            $args[$p['param']] = $p['value'];
        }

        $this->request = call_user_func($fqcn . '::fromArray', $args);
    }

    /**
     * @When /^I execute use case$/
     */
    public function iExecuteUseCase()
    {
        $this->response = $this->usecase->execute($this->request);
    }

    /**
     * @Then /^I should get a response "([^"]*)" with:$/
     */
    public function iShouldGetAWith($name, TableNode $params)
    {
        $fqcn = $this->buildUseCaseClassName($name, 'Response');

        if (!$this->response instanceof $fqcn) {
            throw new \Exception('Incorrect response type');
        }

        $this->assertGetterParamsMatch($this->response, $params);
    }

    /**
     * @Given /^Items "([^"]*)" in response should have "([^"]*)" values:$/
     */
    public function itemsInResponseShouldHaveValues($responseField, $paramName, TableNode $values)
    {
        $getter = 'get' . ucfirst($responseField);
        $actual = array_map(
            function ($elem) use ($paramName) {
               return $elem[$paramName];
            },
            $this->response->$getter()
        );

        $expected = array_map(
            function ($elem) {
                return $elem['value'];
            },
            $values->getHash()
        );

        if (array_diff($expected, $actual) != []) {
            throw new \Exception('Values don\'t match');
        }
    }

    /**
     * @param $name
     * @param $subType
     * @return string
     */
    private function buildUseCaseClassName($name, $subType)
    {
        return 'Play\UseCase\\' . ucfirst($name) . $subType;
    }

    /**
     * @param $object
     * @param TableNode $params
     * @throws Exception
     */
    private function assertGetterParamsMatch($object, TableNode $params)
    {
        foreach ($params->getHash() as $p) {
            $getter = 'get' . ucfirst($p['param']);

            if ($object->$getter() != $p['value']) {
                throw new Exception(sprintf(
                    'Incorrect parameters %s != %s',
                    $object->$getter(),
                    $p['value']
                ));
            }
        }
    }
}
