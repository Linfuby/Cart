<?php
namespace Meling\Tests\Cart\Providers;

/**
 * Class SessionTest
 * @package Meling\Tests\Cart\Providers
 */
class SessionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Provider\Session
     */
    protected $session;

    public function setUp()
    {
        $orm           = new \Meling\Tests\ORMStub();
        $array         = array();
        $session       = new \Meling\Tests\SAPIStub($array);
        $this->session = new \Meling\Cart\Providers\Provider\Session($orm, $session, -6194616, null);
    }

    public function testActions()
    {
        $this->assertInstanceOf('Meling\Cart\Actions', $this->session->actions());
    }

    public function testActionsAfter()
    {
        $this->assertInstanceOf('Meling\Cart\Actions', $this->session->actionsAfter());
    }

    public function testActionsBirthday()
    {
        $this->assertNull($this->session->actionsBirthday());
    }

    public function testActionsDate()
    {
        $this->assertInstanceOf('DateTime', $this->session->actionsDate());
    }

    public function testActionsMarriage()
    {
        $this->assertNull($this->session->actionsMarriage());
    }

    public function testAddresses()
    {
        $this->assertInstanceOf('Meling\Cart\Addresses', $this->session->addresses());
    }

    public function testAttributeOrm()
    {
        $this->assertAttributeInstanceOf('PHPixie\ORM', 'orm', $this->session);
    }

    public function testCards()
    {
        $this->assertInstanceOf('Meling\Cart\Cards', $this->session->cards());
    }

    public function testCity()
    {
        $this->assertInstanceOf('Parishop\ORMWrappers\City\Entity', $this->session->city());
    }

    /**
     * TODO-Linfuby: ?
     */
    public function testCustomer()
    {
        $this->assertNull($this->session->customer());
    }

    public function testEmail()
    {
        $this->assertNull($this->session->email());
    }

    public function testFirstName()
    {
        $this->assertNull($this->session->firstname());
    }

    public function testId()
    {
        $this->assertNull($this->session->id());
    }

    public function testLastName()
    {
        $this->assertNull($this->session->lastname());
    }

    public function testMiddleName()
    {
        $this->assertNull($this->session->middlename());
    }

    public function testModels()
    {
        $this->assertInstanceOf('Meling\Cart\Providers\Models', $this->session->models());
    }

    public function testPhone()
    {
        $this->assertNull($this->session->phone());
    }

    public function testProducts()
    {
        $this->assertInstanceOf('Meling\Cart\Products', $this->session->products());
    }


}
