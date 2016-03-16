<?php
namespace Meling\Cart\Providers;

/**
 * Class Customer
 * @package Meling\Cart\Providers
 */
class Guest extends \Meling\Cart\Providers\Provider
{
    public $id = 0;

    /**
     * @param \Meling\Cart\Orders\Order\Certificates\Certificate $certificate
     * @return int
     */
    public function addCertificate($certificate)
    {
        $certificates = $this->certificates();
        $found        = false;
        foreach($certificates as $id => $cert) {
            if(!empty($cert['certificateId']) && $cert['certificateId'] == $certificate->certificate()->id()) {
                $cert['quantity'] += $certificate->quantity();
                $certificates[$id] = $cert;
                $found             = true;
            }
        }
        if(!$found) {
            $ids = array_keys($certificates);
            if($ids) {
                $id = max($ids) + 1;
            } else {
                $id = 0;
            }
            $certificates[$id] = array(
                'certificateId' => $certificate->certificate()->id(),
                'shopId'        => $certificate->shopId,
                'deliveryId'    => $certificate->deliveryId,
                'shopTariffId'  => $certificate->shopTariffId,
                'addressId'     => $certificate->addressId,
                'pvz'           => $certificate->pvz,
                'image'         => $certificate->image(),
                'price'         => $certificate->price,
                'quantity'      => $certificate->quantity(),
            );
        }
        $this->source()->session()->set('certificates', $certificates);

        return $id;
    }

    /**
     * @param \Meling\Cart\Orders\Order\Products\Product $product
     * @return int
     */
    public function addProduct($product)
    {
        $products = $this->products();
        $found    = null;
        foreach($products as $id => $prod) {
            if(!empty($prod['optionId']) && $prod['optionId'] == $product->option()->id()) {
                $prod['quantity'] += $product->quantity();
                $products[$id] = $prod;
                $found         = true;
            }
        }
        if(!$found) {
            $ids = array_keys($products);
            if($ids) {
                $id = max($ids) + 1;
            } else {
                $id = 0;
            }
            $products[$id] = array(
                'optionId'     => $product->option()->id(),
                'shopId'       => $product->shopId,
                'deliveryId'   => $product->deliveryId,
                'shopTariffId' => $product->shopTariffId,
                'addressId'    => $product->addressId,
                'pvz'          => $product->pvz,
                'price'        => $product->price,
                'quantity'     => $product->quantity(),
            );
        }
        $this->source()->session()->set('products', $products);

        return $id;
    }

    /**
     * @return array
     */
    public function cards()
    {
        return array();
    }

    /**
     * @return array
     */
    public function certificates()
    {
        return $this->source()->session()->get('certificates', array());
    }

    public function clearCertificates()
    {
        $this->source()->session()->set('certificates', array());
    }

    public function clearProducts()
    {
        $this->source()->session()->set('products', array());
    }

    /**
     * @return \DateTime
     */
    public function dateActual()
    {
        return new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function dateBirthday()
    {
        return null;
    }

    /**
     * @return \DateTime
     */
    public function dateMarriage()
    {
        return null;
    }

    function id()
    {
        return 0;
    }

    /**
     * @return array
     */
    public function products()
    {
        return $this->source()->session()->get('products', array());
    }

    public function removeCertificates($id)
    {
        $certificates = $this->certificates();
        unset($certificates[$id]);
        $this->source()->session()->set('certificates', $certificates);
    }

    public function removeProducts($id)
    {
        $products = $this->products();
        unset($products[$id]);
        $this->source()->session()->set('products', $products);
    }

}
