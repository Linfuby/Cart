<?php
namespace Meling\Tests\Cart\Providers\Products;

class ModelsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Providers\Models
     */
    protected $models;

    public function setUp()
    {
        $orm          = new \Meling\Tests\ORMStub();
        $this->models = new \Meling\Cart\Providers\Models($orm);
    }

    public function testAsArray()
    {
        $this->assertEquals(
            array(
                'option'      => new \Meling\Cart\Providers\Models\Option($this->models),
                'certificate' => new \Meling\Cart\Providers\Models\Certificate($this->models),
            ), $this->models->asArray()
        );
    }

    public function testCertificate()
    {
        $this->assertInstanceOf('Meling\Cart\Providers\Models\Certificate', $this->models->certificate());
    }

    public function testOption()
    {
        $this->assertInstanceOf('Meling\Cart\Providers\Models\Option', $this->models->option());
    }

}

