<?php
/**
 * Created by PhpStorm.
 * User: manager
 * Date: 29.03.2016
 * Time: 16:24
 */

namespace Meling\Cart;

class ObjectsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Objects
     */
    protected $objects;

    public function setUp()
    {
        $this->objects = new \Meling\Cart\Objects(
            array(
                (object)array(
                    'id'           => 1,
                    'option'       => null,
                    'price'        => 100,
                    'quantity'     => 1,
                    'shopId'       => null,
                    'deliveryId'   => null,
                    'shopTariffId' => null,
                    'addressId'    => null,
                ),
            ),
            array(
                (object)array(
                    'id'           => 1,
                    'certificate'  => null,
                    'price'        => 100,
                    'quantity'     => 1,
                    'shopId'       => null,
                    'deliveryId'   => null,
                    'shopTariffId' => null,
                    'addressId'    => null,
                ),
            )
        );
    }

    public function testAttributeCertificates()
    {
        $this->assertAttributeInternalType('array', 'certificates', $this->objects);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInternalType('array', 'products', $this->objects);
    }

    public function testMethodAdd()
    {
        $object = \Meling\Cart\Objects\OptionTest::getOption();
        $this->assertInternalType('int', $this->objects->add($object));
    }

    public function testMethodAsArray()
    {
        $this->assertInternalType('array', $this->objects->asArray());
    }

}
