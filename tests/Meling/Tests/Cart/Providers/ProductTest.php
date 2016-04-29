<?php
namespace Meling\Tests\Cart\Providers;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Product
     */
    protected $product;

    public function setUp()
    {
        $orm           = new \Meling\Tests\ORM();
        $option        = $orm->query('option')->in('-169235494')->findOne();
        $this->product = new \Meling\Cart\Providers\Product(1, $option, 2, 500);
        $orm->disconnect();
    }

    public function testAttributeOption()
    {
        $this->assertAttributeInstanceOf('\Meling\Tests\ORMWrappers\Entities\Option', 'entity', $this->product);
    }

}
