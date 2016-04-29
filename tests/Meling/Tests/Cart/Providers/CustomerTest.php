<?php
namespace Meling\Tests\Cart\Providers;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Customer
     */
    protected $customer;

    public function setUp()
    {
        $this->customer = new \Meling\Cart\Providers\Customer(1, 'Мелинг', 'Вадим', 'Александрович', 'vadim@meling.ru', '+79372179377', '1983-03-10', '2011-03-18');
    }

    public function testAttributeId()
    {
        $this->assertEquals(1, 'id', $this->customer);
    }

}
