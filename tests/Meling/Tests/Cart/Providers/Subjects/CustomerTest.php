<?php
namespace Meling\Tests\Cart\Providers\Subjects;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    public static $customer;

    /**
     * @return \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    public static function getCustomer()
    {
        if(self::$customer === null) {
            $orm = \Meling\Tests\CartTest::getORM();

            self::$customer = $orm->query('customer')->findOne();
        }

        return self::$customer;
    }

    public static function getSubject()
    {
        $orm = \Meling\Tests\CartTest::getORM();

        return new \Meling\Cart\Providers\Subjects\Customer(CustomerTest::getCustomer(), $orm->repositories());
    }

    public function test()
    {
        $this->assertEquals(1, 1);
    }

}
