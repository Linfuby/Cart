<?php
namespace Meling\Tests\Cart\Actions;

/**
 * Class ActionTest
 * @package Meling\Tests\Cart\Actions
 */
class ActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Actions\Action
     */
    protected $action;

    public function setUp()
    {
        $this->action = new \Meling\Cart\Actions\Action();
    }

    public function testCalculate()
    {
        $card     = new \Meling\Cart\Cards\Card();
        $orm      = new \Meling\Tests\ORMStub();
        $array    = array();
        $session  = new \Meling\Tests\SAPIStub($array);
        $provider = new \Meling\Cart\Providers\Provider\Session($orm, $session, -6081056, null);
        $products = new \Meling\Cart\Products\Session($provider, $session);
        $this->assertEquals(null, $this->action->calculate($card, $products));
    }

    public function testId()
    {
        $this->assertEquals(null, $this->action->id());
    }

    public function testName()
    {
        $this->assertEquals(null, $this->action->name());
    }

    public function testUseCard()
    {
        $this->assertTrue($this->action->useCard());
    }

    public function testUseSpecial()
    {
        $this->assertTrue($this->action->useSpecial());
    }


}
