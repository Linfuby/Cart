<?php
namespace Meling\Tests;

/**
 * Class CartTest
 * @package Meling\Tests
 */
class CartTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Meling\Cart */
    protected $cart;

    public function setUp()
    {
        /** @var \Meling\Cart\Providers\Provider $provider */
        $provider   = $this->getMockBuilder('Meling\Cart\Providers\Provider')
            ->disableOriginalConstructor()
            ->getMock();
        $this->cart = new \Meling\Cart($provider);
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('Meling\Cart\Providers\Provider', 'provider', $this->cart);
    }

}

