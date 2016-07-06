<?php
namespace Meling\Tests\Cart\Providers\Products\Models;

/**
 * Class OptionTest
 * @package Meling\Tests\Cart\Providers\Products\Models
 */
class OptionTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Meling\Cart\Providers\Models\Option */
    protected $option;

    public function setUp()
    {
        $orm          = new\Meling\Tests\ORMStub();
        $models       = new \Meling\Cart\Providers\Models($orm);
        $this->option = new \Meling\Cart\Providers\Models\Option($models);
    }

    public function testFieldId()
    {
        $this->assertEquals('optionId', $this->option->fieldId());
    }

    public function testModelName()
    {
        $this->assertEquals('option', $this->option->modelName());
    }

}

