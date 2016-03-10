<?php
namespace Meling\Tests\Cart\Providers\Environments;

class EnvironmentTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Environment
     */
    protected $environment;

    /**
     * @var \PHPixie\ORM
     */
    protected $orm;

    public static function getEnvironment($session = array())
    {
        $orm = \Meling\Tests\CartTest::getORM();
        if(!isset($session['actionEmpty'])) {
            $action              = $orm->query('action')->findOne();
            $session['actionId'] = $action->id();
        }
        $session = \Meling\Tests\Cart\Providers\Subjects\SessionTest::getSession($session);

        return new \Meling\Cart\Providers\Environments\Environment($session, $orm->repositories());
    }

    public function setUp()
    {
        $this->environment = $this->getEnvironment();
    }

    public function testAttributeRepositories()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Repositories', 'repositories', $this->environment);
    }

    public function testAttributeSession()
    {
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context\Session\SAPI', 'session', $this->environment);
    }

    public function testMethodAction()
    {
        $this->environment = $this->getEnvironment(array('actionEmpty' => true));
        $this->assertNull($this->environment->action());
    }

    public function testMethodActionIsset()
    {
        $this->assertInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', $this->environment->action());
    }

    public function testMethodActions()
    {
        $this->assertInstanceOf('\PHPixie\ORM\Loaders\Loader\Proxy\Caching', $this->environment->actions());
    }

    public function testMethodActionsActual()
    {
        $this->assertInstanceOf(
            '\PHPixie\ORM\Loaders\Loader\Proxy\Caching', $this->environment->actions(new \DateTime())
        );
    }

    public function testMethodActionsAfter()
    {
        $this->assertInstanceOf('\PHPixie\ORM\Loaders\Loader\Proxy\Caching', $this->environment->actionsAfter());
    }

}
