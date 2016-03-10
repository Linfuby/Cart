<?php
namespace Meling\Tests\Cart\Providers\Subjects;

class OrderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    public static function getOrder()
    {
        $orm = \Meling\Tests\CartTest::getORM();

        return $orm->query('order')->findOne();
    }

    public static function getSubject()
    {
        $orm = \Meling\Tests\CartTest::getORM();

        return new \Meling\Cart\Providers\Subjects\Order(OrderTest::getOrder(), $orm->repositories());
    }

    public function test()
    {
        $this->assertEquals(1, 1);
    }

}
