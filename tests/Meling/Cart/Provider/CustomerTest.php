<?php
namespace Meling\Cart\Provider;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Provider\Order
     */
    protected $provider;

    public static function getProvider($id = null, $data = array())
    {
        $orm = \Meling\CartTest::getORM();
        /**
         * @var \Meling\Cart\Wrappers\Order\Entity $order
         */
        $customers = $orm->query('customer');
        if($id !== null) {
            $customers->in($id);
        }
        $customer = $customers->findOne(
            array(
                'cartCertificates',
                'cartCertificates.certificate',
                'carts',
                'carts.option',
            )
        );
        foreach($data as $name => $value) {
            $customer->setField($name, $value);
        }

        return new \Meling\Cart\Provider\Customer($customer);
    }

    public function setUp()
    {
        $this->provider = $this->getProvider();
    }

    public function tearDown()
    {
        \Meling\CartTest::getDatabase()->get()->disconnect();
    }

    public function testAttributeOrder()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Wrappers\Customer\Entity', 'customer', $this->provider);
    }

    public function testMethodObjects()
    {
        $this->assertInstanceOf('\Meling\Cart\Objects', $this->provider->objects());
    }

}
