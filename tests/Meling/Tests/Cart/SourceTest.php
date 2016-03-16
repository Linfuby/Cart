<?php
namespace Meling\Tests\Cart;

class SourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Source
     */
    protected $source;

    public static function getSession($session = array())
    {
        return new SAPIStub($session);
    }

    /**
     * Получаем источник данных
     * @param array $session
     * @param string $actionTypeId
     * @return \Meling\Cart\Source
     */
    public static function getSource($session = array(), $actionTypeId = null)
    {
        $orm = \Meling\Tests\CartTest::getORM();
        if($actionTypeId) {
            $session['actionId'] = $orm->query('action')->where('actionTypeId', $actionTypeId)->findOne()->id();
        }
        $session = \Meling\Tests\Cart\SourceTest::getSession($session);

        return new \Meling\Cart\Source($session, $orm->repositories());
    }

    public function setUp()
    {
        $this->source = $this->getSource();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getORM()->builder()->database()->connection('default')->disconnect();
    }

    /**
     * Атрибут Репозиториев ORM
     */
    public function testAttributeRepositories()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Repositories', 'repositories', $this->source);
    }

    /**
     * Атрибут Сессии
     */
    public function testAttributeSession()
    {
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context\Session', 'session', $this->source);
    }

    /**
     * Текущая акция из Сессии
     */
    public function testMethodAction()
    {
        $this->source = $this->getSource(array(), 53001);
        $this->assertInstanceOf('\PHPixie\ORM\Models\Type\Database\Entity', $this->source->action());
    }

    /**
     * Текущая акция из Сессии пустая
     */
    public function testMethodActionEmpty()
    {
        $this->assertNull($this->source->action());
    }

    /**
     * Доступные Акции на текущий момент
     */
    public function testMethodActions()
    {
        $this->assertInstanceOf('\PHPixie\ORM\Loaders\Loader\Proxy\Caching', $this->source->getActions());
    }

    /**
     * Доступные Акции на указанную дату
     */
    public function testMethodActionsActual()
    {
        $this->assertInstanceOf(
            '\PHPixie\ORM\Loaders\Loader\Proxy\Caching', $this->source->getActions(false, new \DateTime())
        );
    }

    /**
     * Доступные постпродажные Акции
     */
    public function testMethodActionsAfter()
    {
        $this->assertInstanceOf('\PHPixie\ORM\Loaders\Loader\Proxy\Caching', $this->source->getActions(true));
    }

    /**
     * Получение Запроса
     */
    public function testMethodQuery()
    {
        $this->assertInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Query', $this->source->query('user'));
    }

    /**
     * Получение Репозитория
     */
    public function testMethodRepository()
    {
        $this->assertInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Repository', $this->source->repository('user'));
    }

    /**
     * Получение Сессии
     */
    public function testMethodSession()
    {
        $this->assertInstanceOf('\PHPixie\HTTP\Context\Session', $this->source->session());
    }

}

class SAPIStub extends \PHPixie\HTTP\Context\Session\SAPI
{
    protected $sessionArray;

    protected $sessionStarted = false;

    public function __construct(&$sessionArray)
    {
        $this->sessionArray = &$sessionArray;
    }

    public function isSessionStarted()
    {
        return $this->sessionStarted;
    }

    protected function &session()
    {
        return $this->sessionArray;
    }

    protected function sessionStart()
    {
        $this->sessionStarted = true;
    }
}
