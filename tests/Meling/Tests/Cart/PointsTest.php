<?php
namespace Meling\Tests\Cart;

class PointsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Points
     */
    protected $points;

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
        $orm          = new \Meling\Tests\ORMStub();
        $array        = array(
            'options' => array(
                $this->option1['id']      => $this->option1,
                $this->option2['id']      => $this->option2,
                $this->certificate1['id'] => $this->certificate1,
            ),
        );
        $session      = new \Meling\Tests\SAPIStub($array);
        $provider     = new \Meling\Cart\Providers\Provider\Session($orm, $session, -6194616, null);
        $this->points = new \Meling\Cart\Points($provider->city());
    }

    public function testAsArray()
    {
        $this->assertInstanceOf('ArrayIterator', $this->points->asArray());
    }

}
