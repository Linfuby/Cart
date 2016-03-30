<?php
/**
 * Created by PhpStorm.
 * User: manager
 * Date: 29.03.2016
 * Time: 16:32
 */

namespace Meling\Cart;

class WrappersTest extends \PHPUnit_Framework_TestCase
{

    public function testWrappers()
    {
        $wrappers = new \Meling\Cart\Wrappers();
        $this->assertInstanceOf('\Meling\Cart\Wrappers\Entity', $wrappers->databaseEntityWrapper(new WrappersUser()));
    }

}

class WrappersUser
{
    public function modelName()
    {
        return 'user';
    }
}