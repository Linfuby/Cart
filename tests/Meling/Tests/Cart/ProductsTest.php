<?php
namespace Meling\Tests\Cart;

class ProductsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    /**
     * @var \PHPixie\Database
     */
    protected $database;

    /**
     * @var \PHPixie\ORM
     */
    protected $orm;

    public function setUp()
    {
        $slice          = new \PHPixie\Slice();
        $config         = $slice->arrayData(
            array(
                'default' => array(
                    'driver'     => 'pdo',
                    'connection' => 'mysql:host=localhost;dbname=parishop_pixie',
                    'user'       => 'parishop',
                    'password'   => 'xd7pL2yvcL9yXUZ8fE7C',
                    'database'   => 'parishop_pixie',
                ),
            )
        );
        $this->database = new \PHPixie\Database($config);
        $config         = new \PHPixie\Config($slice);
        $config         = $config->directory(__DIR__, 'config')->arraySlice('orm');
        $wrappers       = new \Meling\Cart\Wrappers();
        $this->orm      = new \PHPixie\ORM(\Meling\Tests\CartTest::getDatabase(), $config, $wrappers);
        $data           = array();
        $provider       = new \Meling\Cart\Providers\Guest($this->orm, new \Meling\Tests\SAPIStub($data));
        $this->products = new \Meling\Cart\Products($provider);
    }

    public function tearDown()
    {
        $this->database->get()->disconnect();
    }

    public function testAttributeProvider()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->products);
    }

    public function testMethodAsArray()
    {
        $option = $this->orm->query('option')->findOne();
        $this->products->add(1, $option, null, 1, 'image');
        $this->assertInternalType('array', $this->products->asArray());
    }

}
