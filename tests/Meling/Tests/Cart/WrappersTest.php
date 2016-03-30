<?php
namespace Meling\Tests\Cart;

class WrappersTest extends \PHPUnit_Framework_TestCase
{

    public function testWrappersCustomer()
    {
        $wrappers = new \Meling\Cart\Wrappers();
        $this->assertInstanceOf('\Meling\Cart\Wrappers\Customer\Entity', $wrappers->databaseEntityWrapper(new WrappersCustomer()));
    }

    public function testWrappersDefault()
    {
        $wrappers = new \Meling\Cart\Wrappers();
        $this->assertInstanceOf('\Meling\Cart\Wrappers\Entity', $wrappers->databaseEntityWrapper(new WrappersUser()));
    }

}

class WrappersCustomer
{
    public function modelName()
    {
        return 'customer';
    }
}

class WrappersUser
{
    public function modelName()
    {
        return 'user';
    }
}