<?php
namespace Meling\Cart\Objects;

class OptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Objects\Option
     */
    protected $option;

    public static function getOption($id = null)
    {
        /**
         * @var \PHPixie\ORM\Wrappers\Type\Database\Entity $option
         */
        $options = \Meling\CartTest::getORM()->query('option');
        if($id !== null) {
            $options->in($id);
        }
        $option = $options->findOne();

        return new \Meling\Cart\Objects\Option($option->id(), $option, $option->getField('price'));
    }

    public function setUp()
    {
        $this->option = $this->getOption();
    }

    public function tearDown()
    {
        \Meling\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeAddressId()
    {
        $this->assertAttributeEquals(null, 'addressId', $this->option);
    }

    public function testAttributeDeliveryId()
    {
        $this->assertAttributeEquals(null, 'deliveryId', $this->option);
    }

    public function testAttributeId()
    {
        $this->assertAttributeInternalType('string', 'id', $this->option);
    }

    public function testAttributeOption()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Wrappers\Type\Database\Entity', 'entity', $this->option);
    }

    public function testAttributePrice()
    {
        $this->assertAttributeInternalType('int', 'price', $this->option);
    }

    public function testAttributeQuantity()
    {
        $this->assertAttributeInternalType('int', 'quantity', $this->option);
    }

    public function testAttributeShopId()
    {
        $this->assertAttributeEquals(null, 'shopId', $this->option);
    }

    public function testAttributeShopTariffId()
    {
        $this->assertAttributeEquals(null, 'shopTariffId', $this->option);
    }

    public function testMethodAddressId()
    {
        $this->assertEquals(null, $this->option->addressId());
    }

    public function testMethodCertificate()
    {
        $this->assertInstanceOf('\PHPixie\ORM\Wrappers\Type\Database\Entity', $this->option->entity());
    }

    public function testMethodDeliveryId()
    {
        $this->assertEquals(null, $this->option->deliveryId());
    }

    public function testMethodId()
    {
        $this->assertInternalType('string', $this->option->id());
    }

    public function testMethodPrice()
    {
        $this->assertInternalType('int', $this->option->price());
    }

    public function testMethodQuantity()
    {
        $this->assertInternalType('int', $this->option->quantity());
    }

    public function testMethodShopId()
    {
        $this->assertEquals(null, $this->option->shopId());
    }

    public function testMethodShopTariffId()
    {
        $this->assertEquals(null, $this->option->shopTariffId());
    }

}
