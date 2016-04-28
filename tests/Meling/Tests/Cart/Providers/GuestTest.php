<?php
namespace Meling\Tests\Cart\Providers;

/**
 * Провайдер Гостя
 * 1. Сессия
 * Class GuestTest
 * @package Meling\Tests\Cart\Provider
 */
class GuestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Guest
     */
    protected $guest;

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
        $this->guest    = new \Meling\Cart\Providers\Guest($this->orm, new \Meling\Tests\SAPIStub($data));
    }

    public function tearDown()
    {
        $this->database->get()->disconnect();
    }

    public function testAttributeOrder()
    {
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context\Session', 'session', $this->guest);
    }

    public function testMethodAddObjectCertificate()
    {
        $certificate = $this->orm->query('certificate')->findOne();
        $this->assertInternalType('int', $this->guest->addObject(null, $certificate));
    }

    public function testMethodAddObjectOption()
    {
        $option = $this->orm->query('option')->findOne();
        $this->assertInternalType('int', $this->guest->addObject(null, $option, null, null, 'image.jpg'));
    }

    public function testMethodObjects()
    {
        $this->assertInternalType('array', $this->guest->objects());
    }

}
