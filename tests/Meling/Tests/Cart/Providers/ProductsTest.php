<?php
namespace Meling\Tests\Cart\Providers;

/**
 * Class ProductsTest
 * @package Meling\Tests\Cart\Providers
 */
class ProductsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Products\Session
     */
    protected $products;

    public function setUp()
    {
        $orm            = new \Meling\Tests\ORMStub();
        $array          = array();
        $session        = new \Meling\Tests\SAPIStub($array);
        $provider       = new \Meling\Cart\Providers\Provider\Session($orm, $session, -6194616, null);
        $this->products = new \Meling\Cart\Products\Session($provider, $session);
    }

    public function testAddCertificate()
    {
        $this->assertInstanceOf('Meling\Cart\Products\Product\Certificate', $this->products->addCertificate('147409996001'));
    }

    public function testAddOption()
    {
        $this->assertInstanceOf('Meling\Cart\Products\Product\Option', $this->products->addOption('-218981758'));
    }

    public function testAsArray()
    {
        $this->assertInstanceOf('ArrayIterator', $this->products->asArray());
    }

    public function testAttributeOrm()
    {
        $this->assertAttributeInstanceOf('Meling\Cart\Providers\Provider', 'provider', $this->products);
    }

    public function testAttributeSession()
    {
        $this->assertAttributeInstanceOf('PHPixie\HTTP\Context\Session', 'session', $this->products);
    }

    public function testClear()
    {
        $this->products->clear();
        $this->assertEquals(0, $this->products->count());
    }

    public function testEditCertificate()
    {
        $this->products->addCertificate('147409996001');
        $this->assertInstanceOf('Meling\Cart\Products\Product\Certificate', $this->products->addCertificate('147409996001'));
    }

    public function testEditOption()
    {
        $this->products->addOption('-218981758');
        $this->assertInstanceOf('Meling\Cart\Products\Product\Option', $this->products->addOption('-218981758'));
    }

    public function testGetCertificate()
    {
        $this->products->addCertificate('147409996001');
        $this->assertInstanceOf('Meling\Cart\Products\Product\Certificate', $this->products->get('147409996001'));
    }

    public function testGetOption()
    {
        $this->products->addOption('-169235492');
        $this->assertInstanceOf('Meling\Cart\Products\Product\Option', $this->products->get('-169235492'));
    }

    public function testRemove()
    {
        $this->products->addCertificate('147409994001');
        $this->products->remove('147409994001');
        $this->assertEquals(0, $this->products->count());
    }

}
