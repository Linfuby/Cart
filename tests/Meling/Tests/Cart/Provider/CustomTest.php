<?php
namespace Meling\Tests\Cart\Provider;

/**
 * Провайдер Данных
 * 1. Массив Опций
 * 2. Массив Сертификатов
 * Class CustomTest
 * @package Meling\Tests\Cart\Provider
 */
class CustomTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Provider\Custom
     */
    protected $provider;

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
        );
        $this->option2      = (object)array(
            'id'           => 2,
            'option'       => null,
            'price'        => 200,
            'quantity'     => 2,
            'shopId'       => 2,
            'shopTariffId' => 2,
            'addressId'    => 2,
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
        );
        $data               = array();
        $provider           = new \Meling\Cart\Provider\Guest(new SAPIStub($data));
        $this->provider     = new \Meling\Cart\Provider\Custom(
            $provider, array(
            $this->option1,
            $this->option2,
        ), array($this->certificate1, $this->certificate2)
        );
    }

    public function testAttributeCertificates()
    {
        $this->assertAttributeEquals(array($this->certificate1, $this->certificate2), 'certificates', $this->provider);
    }

    public function testAttributeOptions()
    {
        $this->assertAttributeEquals(array($this->option1, $this->option2), 'options', $this->provider);
    }

    public function testMethodObjects()
    {
        $this->assertInstanceOf('\Meling\Cart\Objects', $this->provider->objects());
    }
    public function testMethodRewards()
    {
        $this->assertInternalType('int', $this->provider->rewards());
    }

}
