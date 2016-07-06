<?php
namespace Meling\Tests\Cart\Providers\Products;

class SessionTest extends \PHPixie\Test\Testcase
{
    /**
     * @var \Meling\Cart\Products\Session
     */
    protected $session;

    protected $option1      = array(
        'id'           => '-169235494',
        'quantity'     => 1,
        'price'        => 1250,
        'shopId'       => null,
        'shopTariffId' => null,
        'cityId'       => null,
        'addressId'    => null,
        'pvz'          => null,
    );

    protected $option2      = array(
        'id'           => '-169235492',
        'quantity'     => 2,
        'price'        => 1520,
        'shopId'       => null,
        'shopTariffId' => null,
        'cityId'       => null,
        'addressId'    => null,
        'pvz'          => null,
    );

    protected $certificate1 = array(
        'id'           => '147409994001',
        'quantity'     => 1,
        'price'        => 1500,
        'shopId'       => null,
        'shopTariffId' => null,
        'cityId'       => null,
        'addressId'    => null,
        'pvz'          => null,
    );

    public function setUp()
    {
        $orm           = new \Meling\Tests\ORMStub();
        $array         = array(
            'options' => array($this->option1['id'] => $this->option1),
        );
        $session       = new \Meling\Tests\SAPIStub($array);
        $provider      = new \Meling\Cart\Providers\Provider\Session($orm, $session, -6194616, null);
        $this->session = new \Meling\Cart\Products\Session($provider, $session);
    }

    public function testAddCertificate()
    {
        $session = [
            'options'      => [
                $this->option1['id'] => $this->option1,
            ],
            'certificates' => [
                $this->certificate1['id'] => $this->certificate1,
            ],
        ];
        $this->session->addCertificate($this->certificate1['id'], $this->certificate1['quantity'], $this->certificate1['price']);
        $this->assertEquals($session, $this->session->session()->asArray());
    }

    public function testAddOption()
    {
        $session = [
            'options'      => [
                $this->option1['id'] => $this->option1,
                $this->option2['id'] => $this->option2,
            ],
            'certificates' => [],
        ];
        $this->session->addOption($this->option2['id'], $this->option2['quantity'], $this->option2['price']);
        $this->assertEquals($session, $this->session->session()->asArray());
    }

    public function testAttributeSession()
    {
        $this->assertAttributeInstanceOf('\PHPixie\HTTP\Context\Session', 'session', $this->session);
    }

    public function testClear()
    {
        $session = [
            'options'      => [],
            'certificates' => [],
        ];
        $this->session->clear();
        $this->assertEquals($session, $this->session->session()->asArray());
    }

    public function testRemoveCertificate()
    {
        $session = [
            'options'      => [
                $this->option1['id'] => $this->option1,
            ],
            'certificates' => [],
        ];
        $this->session->addCertificate($this->certificate1['id'], $this->certificate1['quantity'], $this->certificate1['price']);
        $this->session->remove($this->certificate1['id']);
        $this->assertEquals($session, $this->session->session()->asArray());
    }

    public function testRemoveOption()
    {
        $session = [
            'options'      => [
                $this->option2['id'] => $this->option2,
            ],
            'certificates' => [],
        ];
        $this->session->addOption($this->option2['id'], $this->option2['quantity'], $this->option2['price']);
        $this->session->remove($this->option1['id']);
        $this->assertEquals($session, $this->session->session()->asArray());
    }


}
