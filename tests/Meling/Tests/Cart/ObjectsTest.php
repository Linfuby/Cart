<?php
namespace Meling\Tests\Cart;

class ObjectsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Objects
     */
    protected $objects;

    protected $option1;

    protected $option2;

    protected $certificate1;

    protected $certificate2;

    public function setUp()
    {
        $this->option1      = (object)array(
            'id'           => 1,
            'option'       => null,
            'price'        => 100,
            'quantity'     => 1,
            'shopId'       => 1,
            'shopTariffId' => null,
            'addressId'    => null,
            'pvz'          => 'pvz1',
        );
        $this->option2      = (object)array(
            'id'           => 2,
            'option'       => null,
            'price'        => 200,
            'quantity'     => 2,
            'shopId'       => 2,
            'shopTariffId' => 2,
            'addressId'    => 2,
            'pvz'          => 'pvz2',
        );
        $this->certificate1 = (object)array(
            'id'           => 1,
            'certificate'  => null,
            'image'        => 'image1.jpg',
            'price'        => 100,
            'quantity'     => 1,
            'shopId'       => 1,
            'shopTariffId' => null,
            'addressId'    => null,
            'pvz'          => 'pvz1',
        );
        $this->certificate2 = (object)array(
            'id'           => 2,
            'certificate'  => null,
            'image'        => 'image2.jpg',
            'price'        => 200,
            'quantity'     => 2,
            'shopId'       => 2,
            'shopTariffId' => 2,
            'addressId'    => 2,
            'pvz'          => 'pvz2',
        );
        $this->objects      = new \Meling\Cart\Objects(
            array($this->option1, $this->option2),
            array($this->certificate1, $this->certificate2)
        );
    }

    public function testAttributeCertificates()
    {
        $this->assertAttributeEquals(array($this->certificate1, $this->certificate2), 'certificates', $this->objects);
    }

    public function testAttributeOptions()
    {
        $this->assertAttributeEquals(array($this->option1, $this->option2), 'options', $this->objects);
    }

    public function testMethodAdd()
    {
        /**
         * @var \Meling\Cart\Objects\Option $object
         */
        $object = $this->getMock('\Meling\Cart\Objects\Option', array(), array(), '', false);
        $this->assertEquals(4, $this->objects->add($object));
    }

    public function testMethodAsArray()
    {
        $this->objects->asArray();
        $object1 = new \Meling\Cart\Objects\Option($this->option1->id, $this->option1->option, $this->option1->price, $this->option1->quantity, $this->option1->shopId, $this->option1->shopTariffId, $this->option1->addressId, $this->option1->pvz);
        $object2 = new \Meling\Cart\Objects\Option($this->option2->id, $this->option2->option, $this->option2->price, $this->option2->quantity, $this->option2->shopId, $this->option2->shopTariffId, $this->option2->addressId, $this->option2->pvz);
        $object3 = new \Meling\Cart\Objects\Certificate($this->certificate1->id, $this->certificate1->certificate, $this->certificate1->image, $this->certificate1->price, $this->certificate1->quantity, $this->certificate1->shopId, $this->certificate1->shopTariffId, $this->certificate1->addressId, $this->certificate1->pvz);
        $object4 = new \Meling\Cart\Objects\Certificate($this->certificate2->id, $this->certificate2->certificate, $this->certificate2->image, $this->certificate2->price, $this->certificate2->quantity, $this->certificate2->shopId, $this->certificate2->shopTariffId, $this->certificate2->addressId, $this->certificate2->pvz);
        $this->assertEquals(array($object1, $object2, $object3, $object4), $this->objects->asArray());
    }

}
