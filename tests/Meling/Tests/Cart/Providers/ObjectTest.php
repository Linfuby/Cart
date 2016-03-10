<?php
namespace Meling\Tests\Cart\Providers\Objects;

class ObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Objects\Repository
     */
    protected $repository;

    /**
     * @var \Meling\Cart\Providers\Objects\Session
     */
    protected $session;

    /**
     * @var \PHPixie\ORM
     */
    protected $orm;

    public static function getObjectRepository($modelName = 'cart', $fieldName = 'customerId', $id = 1)
    {
        $orm = \Meling\Tests\CartTest::getORM();

        return new \Meling\Cart\Providers\Objects\Repository($orm->repositories()->get($modelName), $fieldName, $id);
    }

    public static function getObjectSession($key = 'products')
    {
        return new \Meling\Cart\Providers\Objects\Session(
            \Meling\Tests\Cart\Providers\Subjects\SessionTest::getSession(), $key
        );
    }

    public function setUp()
    {
        $this->orm        = \Meling\Tests\CartTest::getORM();
        $this->repository = $this->getObjectRepository();
        $this->session    = $this->getObjectSession();
    }


    public function tearDown()
    {
        $this->orm->builder()->database()->connection('default')->disconnect();
    }

    public function testAttributesProvider()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Repository', 'provider', $this->repository);
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context\Session\SAPI', 'provider', $this->session);
    }

    public function testMethodAdd()
    {
        $certificate = $this->orm->query('certificate')->findOne();
        $this->assertEquals(1, $this->session->add($certificate->asObject()));
        $option  = $this->orm->query('option')->findOne();
        $product = array('optionId' => $option->id(), 'quantity' => 1);
        $cart    = $this->orm->query('cart')->orderDescendingBy('id')->findOne();
        $this->assertInternalType('numeric', $this->repository->add($product));
    }

    public function testMethodClear()
    {
        $certificate = $this->orm->query('certificate')->findOne();
        $this->session->add($certificate->asObject());
        $this->assertEquals(array(), $this->session->clear());
        $option  = $this->orm->query('option')->findOne();
        $product = array('optionId' => $option->id(), 'quantity' => 1);
        $this->repository->add($product);
        $this->assertEquals(array(), $this->repository->clear());
    }

    public function testMethodObjects()
    {
        $this->assertInternalType('array', $this->repository->objects());
        $this->assertInternalType('array', $this->session->objects());
    }

    public function testMethodRemove()
    {
        $certificate = $this->orm->query('certificate')->findOne();
        $id          = $this->session->add($certificate->asObject());
        $this->assertInternalType('array', $this->session->remove($id));
        $option  = $this->orm->query('option')->findOne();
        $product = array('optionId' => $option->id(), 'quantity' => 1);
        $id      = $this->repository->add($product);
        $this->assertInternalType('array', $this->repository->remove($id));
    }

}
