<?php
namespace Meling\Cart;

class Context
{
    /**
     * @var Providers\Provider
     */
    protected $provider;

    /**
     * @var array
     */
    protected $products;

    /**
     * @var array
     */
    protected $certificates;

    /**
     * Context constructor.
     * @param Providers\Provider $provider
     */
    public function __construct(Providers\Provider $provider)
    {
        $this->provider = $provider;
    }

    public function certificates()
    {
        if($this->certificates === null) {
            $certificates = array();
            foreach($this->provider->certificates() as $id => $certificate) {
                if(is_array($certificate)) {
                    $certificate = (object)$certificate;
                }
                if($certificate instanceof \PHPixie\ORM\Drivers\Driver\PDO\Entity) {
                    $certificate = $certificate->asObject();
                    $id = $certificate->id;
                }
                if(!empty($certificate->certificateId)) {
                    $cert                     = $this->provider->source()->query('certificate')->in(
                        $certificate->certificateId
                    )->findOne();
                    $certificate->price       = $cert->getField('price');
                    $certificate->certificate = $cert;
                    if(empty($certificate->quantity)) {
                        $certificate->quantity = 1;
                    }
                    if(empty($certificate->customerId)) {
                        $certificate->customerId = $this->provider->id();
                    }
                    if(!empty($certificate->shopId)) {
                        $shop = $this->provider->source()->query('shop')->in($certificate->shopId)->findOne();

                        $certificate->shop = $shop->asObject();
                    } else {
                        $certificate->shopId = null;
                        $certificate->shop   = null;
                    }
                    if(!empty($certificate->shopTariffId)) {
                        $shopTariff = $this->provider->source()->query('shopTariff')->in($certificate->shopTariffId)->findOne(
                        );

                        $certificate->shopTariff = $shopTariff->asObject();
                    } else {
                        $certificate->shopTariffId = null;
                        $certificate->shopTariff   = null;
                    }
                    if(!empty($certificate->addressId)) {
                        $address = $this->provider->source()->query('address')->in($certificate->addressId)->findOne();

                        $certificate->address = $address->asObject();
                    } else {
                        $certificate->addressId = null;
                        $certificate->address   = null;
                    }
                    $certificates[$id] = $certificate;
                }
            }
            $this->certificates = $certificates;
        }

        return $this->certificates;
    }

    public function products()
    {
        if($this->products === null) {
            $products = array();
            foreach($this->provider->products() as $id => $product) {
                if(is_array($product)) {
                    $product = (object)$product;
                }
                if($product instanceof \PHPixie\ORM\Drivers\Driver\PDO\Entity) {
                    $product = $product->asObject();
                    $id = $product->id;
                }
                if(!empty($product->optionId)) {
                    $option          = $this->provider->source()->query('option')->in($product->optionId)->findOne();
                    $product->price  = $option->getField('price');
                    $product->option = $option;
                    if(empty($product->quantity)) {
                        $product->quantity = 1;
                    }
                    if(empty($product->customerId)) {
                        $product->customerId = $this->provider->id();
                    }
                    if(!empty($product->shopId)) {
                        $shop = $this->provider->source()->query('shop')->in($product->shopId)->findOne();

                        $product->shop = $shop->asObject();
                    } else {
                        $product->shopId = null;
                        $product->shop   = null;
                    }
                    if(!empty($product->shopTariffId)) {
                        $shopTariff = $this->provider->source()->query('shopTariff')->in($product->shopTariffId)->findOne();
                        $product->shopTariff = $shopTariff->asObject();
                    } else {
                        $product->shopTariffId = null;
                        $product->shopTariff   = null;
                    }
                    if(!empty($product->addressId)) {
                        $address = $this->provider->source()->query('address')->in($product->addressId)->findOne();

                        $product->address = $address->asObject();
                    } else {
                        $product->addressId = null;
                        $product->address   = null;
                    }
                    $products[$id] = $product;
                }
            }
            $this->products = $products;
        }

        return $this->products;
    }

    public function provider()
    {
        return $this->provider;
    }

}
