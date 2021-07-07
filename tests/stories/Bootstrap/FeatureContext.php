<?php

namespace Kegstar\Test\Stories\ModuleEdge\Bootstrap;

use Behat\Testwork\Hook\Call\BeforeSuite;
use Behat\Testwork\Hook\Scope\BeforeSuiteScope;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Behat\Behat\Context\Context;
use \PHPUnit_Framework_Assert as PHPUnit;
use Whizz\Test\Stories\Gallery\Bootstrap\Feature\CategoryContextTrait;

class FeatureContext implements Context
{
    use CategoryContextTrait;

    /**
     * @var KernelInterface
     */
    private $kernel;
    /**
     * @var Registry
     */
    private $readModelPdoConnection;

    protected $exception;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventBus;

    public function __construct(
        KernelInterface $kernel,
        RegistryInterface $readModelPdoConnection,
        EventDispatcherInterface $eventBus
    )
    {
        $this->kernel = $kernel;
        $this->readModelPdoConnection = $readModelPdoConnection;
        $this->eventBus = $eventBus;
    }

    /**
     * @param string $commandName
     * @param array $parameters
     *
     * @throws \Exception
     */
    private function runSymfonyCommand(string $commandName, array $parameters = []): void
    {
        $application = new Application($this->kernel);
        $application->setAutoExit(false);
        $command = $application->find($commandName);

        $input = new ArrayInput(array_merge(['command' => $command->getName(), '--env' => 'test'], $parameters));

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $command->run($input, $output);
    }

    /**
     * @BeforeSuite
     */
    public static function prepareDatabase(BeforeSuiteScope $scope)
    {
        exec('bin/console doctrine:schema:drop --force --full-database --env=test');
        exec('bin/console doctrine:migrations:migrate --no-interaction --env=test');
    }

    /**
     * Used to inspect exception thrown earlier
     *
     * @Then I confirm the exception was of type :exception
     */
    public function iConfirmTheExceptionWasOfType($exception)
    {
        PHPUnit::assertNotNull($this->exception, 'No exception has been saved for comparison');
        PHPUnit::assertEquals($exception, get_class($this->exception));
    }

    /**
     * Used to inspect exception thrown earlier
     *
     * @Then I confirm the exception had message :message
     */
    public function iConfirmTheExceptionHadMessage($message)
    {
        PHPUnit::assertNotNull($this->exception, 'No exception has been saved for comparison');
        PHPUnit::assertEquals($message, $this->exception->getMessage());
    }

    /**
     * Useful for stopping after scenarios, in order to check database
     *
     * @Then I exit
     */
    public function iExit()
    {
        exit();
    }
}