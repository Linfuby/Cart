<?php
namespace Meling\Tests\Cart\Products;

/**
 * Class OptionTest
 * @package Meling\Tests\Cart\Products
 */
class OptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Products\Option
     */
    protected $option;

    public function setUp()
    {
        $option = null;
        $this->option = new \Meling\Cart\Products\Option(1, $option, 2, 1000, 52, 5, 2, 6, 8, 'pvz');
    }

}
