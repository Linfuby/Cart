<?php
namespace Meling\Tests\Cart;

class ProductsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    protected $option1      = array(
        'id'           => '-169235494',
        'quantity'     => 1,
        'price'        => 1250,
        'shopId'       => null,
        'shopTariffId' => null,
        'cityId'       => null,
        'addressId'    => null,
        'pvz'          => null,
    );

    protected $option2      = array(
        'id'           => '-169235492',
        'quantity'     => 2,
        'price'        => 1520,
        'shopId'       => null,
        'shopTariffId' => null,
        'cityId'       => null,
        'addressId'    => null,
        'pvz'          => null,
    );

    protected $certificate1 = array(
        'id'           => '147409994001',
        'quantity'     => 1,
        'price'        => 1500,
        'shopId'       => null,
        'shopTariffId' => null,
        'cityId'       => null,
        'addressId'    => null,
        'pvz'          => null,
    );

    public function setUp()
    {
        $orm            = new \Meling\Tests\ORMStub();
        $array          = array(
            'options' => array(
                $this->option1['id'] => $this->option1,
            ),
        );
        $session        = new \Meling\Tests\SAPIStub($array);
        $provider       = new \Meling\Cart\Providers\Provider\Session($orm, $session, -6194616, null);
        $this->products = new \Meling\Cart\Products\Session($provider, $session);
    }

    public function testAaArray()
    {
        $this->assertInstanceOf('ArrayIterator', $this->products->asArray());
    }

    public function testAddCertificate()
    {
        $this->products->addCertificate('147409994001');
        $this->assertEquals(2, $this->products->quantity());
    }

    public function testAddOption()
    {
        $this->products->addOption('-169235494');
        $this->assertEquals(2, $this->products->quantity());
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInstanceOf('Meling\Cart\Providers\Provider', 'provider', $this->products);
    }

    public function testClear()
    {
        $this->products->clear();
        $this->assertEquals(0, $this->products->count());
    }

    public function testGet()
    {
        $this->assertInstanceOf('Meling\Cart\Products\Product', $this->products->get('-169235494'));
    }

    /**
     * @expectedException \Exception
     */
    public function testGetThrow()
    {
        $this->products->get('0');
    }

    public function testQuantity()
    {
        $this->assertEquals(1, $this->products->quantity());
    }

    public function testRemove()
    {
        $this->products->remove('-169235494');
        $this->assertEquals(0, $this->products->count());
    }

    public function testTotals()
    {
        $this->assertInstanceOf('Meling\Cart\Totals', $this->products->totals());
    }

}

