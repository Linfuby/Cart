<?php
namespace Meling\Tests\Cart;

class ProductsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

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
        $data               = array();
        $provider           = new \Meling\Cart\Provider\Custom(
            new \Meling\Cart\Provider\Guest(new \Meling\Tests\Cart\Provider\SAPIStub($data)),
            array($this->option1, $this->option2),
            array($this->certificate1, $this->certificate2)
        );
        $this->products     = new \Meling\Cart\Products($provider);
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Provider\Custom', 'provider', $this->products);
    }

    public function testMethodAddCertificate()
    {
        /**
         * @var \Meling\Cart\Objects\Certificate $certificate
         */
        $certificate = $this->getMock('\Meling\Cart\Objects\Certificate', array(), array(), '', false);
        $this->assertInternalType('int', $this->products->addCertificate($certificate));
    }

    public function testMethodAddOption()
    {
        /**
         * @var \Meling\Cart\Objects\Option $option
         */
        $option = $this->getMock('\Meling\Cart\Objects\Option', array(), array(), '', false);
        $this->assertInternalType('int', $this->products->addOption($option));
    }

    public function testMethodAsArray()
    {
        $this->products->asArray();
        $this->assertInternalType('array', $this->products->asArray());
    }

}
