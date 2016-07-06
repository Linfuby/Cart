<?php
namespace Meling\Tests\Cart\Providers\Products\Models;

/**
 * Class CertificateTest
 * @package Meling\Tests\Cart\Providers\Products\Models
 */
class CertificateTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Meling\Cart\Providers\Models\Certificate */
    protected $certificate;

    public function setUp()
    {
        $orm               = new\Meling\Tests\ORMStub();
        $models            = new \Meling\Cart\Providers\Models($orm);
        $this->certificate = new \Meling\Cart\Providers\Models\Certificate($models);
    }

    public function testFieldId()
    {
        $this->assertEquals('certificateId', $this->certificate->fieldId());
    }

    public function testModelName()
    {
        $this->assertEquals('certificate', $this->certificate->modelName());
    }

}

