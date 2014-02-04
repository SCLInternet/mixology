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

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{
    private $usecaseFactory;
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
    }

    /**
     * @When /^I execute use case "([^"]*)" with:$/
     */
    public function iExecuteUseCaseWith($name, TableNode $params)
    {
        $this->response = $this->usecaseFactory
                               ->create($name)
                               ->execute($this->createRequest($name, $params));
    }

    /**
     * @param string $name
     *
     * @return RequestInterface
     */
    private function createRequest($name, TableNode$params)
    {
        $fqcn = $this->buildUseCaseClassName($name, 'Request');

        $args = [];

        foreach ($params->getHash() as $p) {
            $args[$p['param']] = $p['value'];
        }

        return call_user_func($fqcn . '::fromArray', $args);
    }

    /**
     * @Then /^I should get a response "([^"]*)" with:$/
     */
    public function iShouldGetAResponseWith($name, TableNode $params)
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
