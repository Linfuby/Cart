<?php
namespace Meling\Cart\Orders\Order;

/**
 * Class Certificates
 * @package Meling\Cart\Orders\Order
 */
class Certificates
{
    /**
     * @var \Meling\Cart\Providers\Provider
     */
    protected $provider;

    /**
     * @var Certificates\Certificate[]
     */
    protected $certificates = array();

    /**
     * Products constructor
     * @param \Meling\Cart\Providers\Provider $provider
     * @param array                           $certificates
     */
    public function __construct(\Meling\Cart\Providers\Provider $provider, array $certificates = array())
    {
        $this->provider = $provider;
        $this->certificates = $this->requireCertificates($certificates);
    }

    /**
     * @param $certificate
     * @return mixed
     */
    public function add($certificate)
    {
        if($certificate instanceof \PHPixie\ORM\Drivers\Driver\PDO\Entity) {
            $cert = $certificate->certificate();
        } else {
            if(is_array($certificate)) {
                $certificate = (object)$certificate;
            }
            $cert = $certificate->certificate;
        }
        if(empty($certificate->price)) {
            $certificate->price = $cert->price;
        }
        if(empty($certificate->quantity)) {
            $certificate->quantity = 1;
        }
        $certificate = $this->buildCertificate(
            count($this->certificates), $certificate, $certificate->price, $certificate->quantity
        );
        $id          = $this->provider->addCertificate($certificate);
        $certificate->setId($id);
        $this->certificates[$id] = $certificate;
    }

    public function asArray()
    {
        $this->requireCertificates();

        return $this->certificates;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->certificates = array();

        return $this->provider->clearCertificates();
    }

    public function count()
    {
        return count($this->asArray());
    }

    public function get($id)
    {
        $this->requireCertificates();
        if(array_key_exists($id, $this->certificates)) {
            return $this->certificates[$id];
        }
        throw new \Exception('Certificate ' . $id . ' does not exist');
    }

    public function quantity()
    {
        $quantity = 0;
        foreach($this->asArray() as $certificate) {
            $quantity += $certificate->quantity();
        }

        return $quantity;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function remove($id)
    {
        unset($this->certificates[$id]);

        return $this->provider->removeCertificates($id);
    }

    /**
     * @param array $objects
     * @return Certificates\Certificate[]
     */
    protected function requireCertificates(array $objects = array())
    {
        $certificates = array();
        foreach($objects as $object) {
        }

        return $certificates;
    }

    private function buildCertificate($count, $certificate, $price, $quantity)
    {
    }

}
