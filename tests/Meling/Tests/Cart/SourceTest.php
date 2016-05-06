<?php
namespace Meling\Tests\Cart;

class SourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Source
     */
    protected $source;

    public static function getFramework()
    {
        static $framework;
        if(!$framework) {
            $framework = new \Parishop\Framework();
        }

        return $framework;
    }

    /**
     * Получаем источник данных
     * @param array                               $session
     * @param string                              $actionTypeId
     * @param \Parishop\ORMWrappers\Action\Entity $action
     * @return \Meling\Cart\Source
     */
    public static function getSource($session = array(), $actionTypeId = null, $action = null)
    {
        $framework = \Meling\Tests\CartTest::getFramework();
        $framework->builder()->components()->database()->get()->disconnect();
        $orm     = $framework->builder()->components()->orm();
        $domains = $framework->builder()->components()->auth()->domains();
        if($actionTypeId) {
            $action = $orm->query('action')->where('actionTypeId', $actionTypeId)->findOnePreload();
        }
        if($action) {
            $session['actionId'] = $action->id();
        }
        $slice   = new \PHPixie\Slice();
        $cookies = $slice->editableArrayData(array('city_default_id' => '-6081056'));
        $context = new \PHPixie\HTTP\Context($slice->arrayData(), $cookies, new SAPIStub($session));

        return new \Meling\Cart\Source($context, $orm->repositories(), $domains);
    }

    public function setUp()
    {
        $this->source = $this->getSource();
    }

    public function tearDown()
    {
        \Meling\Tests\CartTest::getFramework()->builder()->components()->database()->get()->disconnect();
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
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context', 'context', $this->source);
    }

    /**
     * Текущая акция из Сессии
     */
    public function testMethodAction()
    {
        $this->source = $this->getSource(array(), 53001);
        $this->assertInstanceOf('\Parishop\ORMWrappers\Action\Entity', $this->source->action());
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

    public function testMethodCity()
    {
        $this->assertInstanceOf('\Parishop\ORMWrappers\City\Entity', $this->source->city());
    }

    public function testMethodCookies()
    {
        $this->assertInstanceOf('\PHPixie\Slice\Type\ArrayData\Editable', $this->source->cookies());
    }

    /**
     * Получение Запроса
     */
    public function testMethodQuery()
    {
        $this->assertInstanceOf('\Parishop\ORMWrappers\User\Query', $this->source->query('user'));
    }

    /**
     * Получение Репозитория
     */
    public function testMethodRepository()
    {
        $this->assertInstanceOf('\Parishop\ORMWrappers\User\Repository', $this->source->repository('user'));
    }

    /**
     * Получение Сессии
     */
    public function testMethodSession()
    {
        $this->assertInstanceOf('\PHPixie\HTTP\Context\Session', $this->source->session());
    }

    public function testMethodShop()
    {
        $this->assertInstanceOf('\Parishop\ORMWrappers\Shop\Entity', $this->source->shop());
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

    protected function &session()
    {
        return $this->sessionArray;
    }

    protected function sessionStart()
    {
        $this->sessionStarted = true;
    }
}