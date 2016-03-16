<?php
namespace Meling\Tests\Cart\Orders\Order\Actions\Types;

class TypeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53000
     */
    protected $type53000;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53001
     */
    protected $type53001;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53003
     */
    protected $type53003;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53004
     */
    protected $type53004;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53006
     */
    protected $type53006;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53007
     */
    protected $type53007;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53008
     */
    protected $type53008;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53009
     */
    protected $type53009;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53010
     */
    protected $type53010;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53011
     */
    protected $type53011;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53014
     */
    protected $type53014;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Types\Type53017
     */
    protected $type53017;

    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    protected $action53000;

    protected $action53001;

    protected $action53003;

    protected $action53004;

    protected $action53006;

    protected $action53007;

    protected $action53008;

    protected $action53009;

    protected $action53010;

    protected $action53011;

    protected $action53014;

    protected $action53017;

    public function setUp()
    {
        $orm            = \Meling\Tests\CartTest::getORM();
        $this->products = \Meling\Tests\Cart\Orders\Order\ProductsTest::getProducts();
        $source         = \Meling\Tests\Cart\SourceTest::getSource();
        $this->products->clear();
        foreach($source->query('option')->limit(3)->find() as $option) {
            $this->products->add(array('option' => $option));
        }
        $this->action53000 = $orm->query('action')->where('actionTypeId', 53000)->findOne();
        $this->type53000   = new \Meling\Cart\Orders\Order\Actions\Types\Type53000($this->products, $this->action53000);
        $this->action53001 = $orm->query('action')->where('actionTypeId', 53001)->findOne();
        $this->type53001   = new \Meling\Cart\Orders\Order\Actions\Types\Type53001($this->products, $this->action53001);
        $this->action53003 = $orm->query('action')->where('actionTypeId', 53003)->findOne();
        $this->type53003   = new \Meling\Cart\Orders\Order\Actions\Types\Type53003($this->products, $this->action53003);
        $this->action53004 = $orm->query('action')->where('actionTypeId', 53004)->findOne();
        $this->type53004   = new \Meling\Cart\Orders\Order\Actions\Types\Type53004($this->products, $this->action53004);
        $this->action53006 = $orm->query('action')->where('actionTypeId', 53006)->findOne();
        $this->type53006   = new \Meling\Cart\Orders\Order\Actions\Types\Type53006($this->products, $this->action53006);
        $this->action53007 = $orm->query('action')->where('actionTypeId', 53007)->findOne();
        $this->type53007   = new \Meling\Cart\Orders\Order\Actions\Types\Type53007($this->products, $this->action53007);
        $this->action53008 = $orm->query('action')->where('actionTypeId', 53008)->findOne();
        $this->type53008   = new \Meling\Cart\Orders\Order\Actions\Types\Type53008($this->products, $this->action53008);
        $this->action53009 = $orm->query('action')->where('actionTypeId', 53009)->findOne();
        $this->type53009   = new \Meling\Cart\Orders\Order\Actions\Types\Type53009($this->products, $this->action53009);
        $this->action53010 = $orm->query('action')->where('actionTypeId', 53010)->findOne();
        $this->type53010   = new \Meling\Cart\Orders\Order\Actions\Types\Type53010($this->products, $this->action53010);
        $this->action53011 = $orm->query('action')->where('actionTypeId', 53011)->findOne();
        $this->type53011   = new \Meling\Cart\Orders\Order\Actions\Types\Type53011($this->products, $this->action53011);
        $this->action53014 = $orm->query('action')->where('actionTypeId', 53014)->findOne();
        $this->type53014   = new \Meling\Cart\Orders\Order\Actions\Types\Type53014($this->products, $this->action53014);
        $this->action53017 = $orm->query('action')->where('actionTypeId', 53017)->findOne();
        $this->type53017   = new \Meling\Cart\Orders\Order\Actions\Types\Type53017($this->products, $this->action53017);
    }

    public function testAttributeCard()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53000);
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53001);
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53003);
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53004);
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53006);
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53007);
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53008);
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53009);
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53010);
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53011);
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53014);
        $this->assertAttributeInstanceOf('\Meling\Cart\Orders\Order\Products', 'products', $this->type53017);
    }

    public function testAttributeProducts()
    {
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53000);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53001);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53003);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53004);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53006);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53007);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53008);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53009);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53010);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53011);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53014);
        $this->assertAttributeInstanceOf('\PHPixie\ORM\Drivers\Driver\PDO\Entity', 'action', $this->type53017);
    }

    public function testMethodName()
    {
        $this->assertEquals($this->action53000->getField('name'), $this->type53000->name());
        $this->assertEquals('Ассортимент', $this->type53001->name());
        $this->assertEquals($this->action53003->getField('name'), $this->type53003->name());
        $this->assertEquals($this->action53004->getField('name'), $this->type53004->name());
        $this->assertEquals($this->action53006->getField('name'), $this->type53006->name());
        $this->assertEquals($this->action53007->getField('name'), $this->type53007->name());
        $this->assertEquals($this->action53008->getField('name'), $this->type53008->name());
        $this->assertEquals($this->action53009->getField('name'), $this->type53009->name());
        $this->assertEquals($this->action53010->getField('name'), $this->type53010->name());
        $this->assertEquals($this->action53011->getField('name'), $this->type53011->name());
        $this->assertEquals($this->action53014->getField('name'), $this->type53014->name());
        $this->assertEquals($this->action53017->getField('name'), $this->type53017->name());
    }

    public function testMethodNameEmpty()
    {
        $this->type53000 = new \Meling\Cart\Orders\Order\Actions\Types\Type53000($this->products);
        $this->type53001 = new \Meling\Cart\Orders\Order\Actions\Types\Type53001($this->products);
        $this->type53003 = new \Meling\Cart\Orders\Order\Actions\Types\Type53003($this->products);
        $this->type53004 = new \Meling\Cart\Orders\Order\Actions\Types\Type53004($this->products);
        $this->type53006 = new \Meling\Cart\Orders\Order\Actions\Types\Type53006($this->products);
        $this->type53007 = new \Meling\Cart\Orders\Order\Actions\Types\Type53007($this->products);
        $this->type53008 = new \Meling\Cart\Orders\Order\Actions\Types\Type53008($this->products);
        $this->type53009 = new \Meling\Cart\Orders\Order\Actions\Types\Type53009($this->products);
        $this->type53010 = new \Meling\Cart\Orders\Order\Actions\Types\Type53010($this->products);
        $this->type53011 = new \Meling\Cart\Orders\Order\Actions\Types\Type53011($this->products);
        $this->type53014 = new \Meling\Cart\Orders\Order\Actions\Types\Type53014($this->products);
        $this->type53017 = new \Meling\Cart\Orders\Order\Actions\Types\Type53017($this->products);
        $this->assertNull($this->type53000->name());
        $this->assertNull($this->type53001->name());
        $this->assertNull($this->type53003->name());
        $this->assertNull($this->type53004->name());
        $this->assertNull($this->type53006->name());
        $this->assertNull($this->type53007->name());
        $this->assertNull($this->type53008->name());
        $this->assertNull($this->type53009->name());
        $this->assertNull($this->type53010->name());
        $this->assertNull($this->type53011->name());
        $this->assertNull($this->type53014->name());
        $this->assertNull($this->type53017->name());
    }


    public function testMethodTotal()
    {
        $this->assertInternalType('int', $this->type53000->total());
        $this->assertInternalType('int', $this->type53001->total());
        $this->assertInternalType('int', $this->type53003->total());
        $this->assertInternalType('int', $this->type53004->total());
        $this->assertInternalType('int', $this->type53006->total());
        $this->assertInternalType('int', $this->type53007->total());
        $this->assertInternalType('int', $this->type53008->total());
        $this->assertInternalType('int', $this->type53009->total());
        $this->assertInternalType('int', $this->type53010->total());
        $this->assertInternalType('int', $this->type53011->total());
        $this->assertInternalType('int', $this->type53014->total());
        $this->assertInternalType('int', $this->type53017->total());
    }

}
