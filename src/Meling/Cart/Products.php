<?php
namespace Meling\Cart;

/**
 * Class Products
 * @package Meling\Cart
 */
class Products extends \ArrayObject
{
    /**
     * @var Providers\Provider
     */
    protected $provider;

    /**
     * @var Providers\Products
     */
    protected $options;

    /**
     * @var Providers\Products
     */
    protected $certificates;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var Totals
     */
    protected $totals;

    /**
     * @var Points
     */
    private $points;

    /**
     * @param Providers\Provider $provider
     * @param Points             $points
     * @param Providers\Products $options
     * @param Providers\Products $certificates
     * @param array              $products
     */
    public function __construct(Providers\Provider $provider, Points $points, Providers\Products $options, Providers\Products $certificates, array $products = array())
    {
        $this->provider     = $provider;
        $this->points       = $points;
        $this->options      = $options;
        $this->certificates = $certificates;
        parent::__construct($products);
    }

    /**
     * @param string $id
     * @param string $certificateId
     * @param int    $quantity
     * @param int    $price
     * @param string $pointId
     * @param string $shopId
     * @param string $shopTariffId
     * @param string $cityId
     * @param string $addressId
     * @param string $pvz
     * @return Products\Certificate
     * @throws \Exception
     */
    public function addCertificate($id, $certificateId, $quantity = 1, $price = null, $pointId = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = null)
    {
        if($pointId) {
            try {
                $this->points->get($pointId);
            } catch(\Exception $e) {
                $pointId = null;
            }
        }
        if($this->certificates->offsetExists($id)) {
            $certificate = $this->certificates->offsetGet($id);
            $certificate = $this->certificates->edit($id, $quantity + $certificate->quantity, $pointId, $shopId, $shopTariffId, $cityId, $addressId, $pvz);
        } else {
            if($price === null) {
                $certificate = $this->provider->loadCertificate($certificateId);
                $price       = $certificate->price;
            }
            $certificate = $this->certificates->add($certificateId, $quantity, $price, $pointId, $shopId, $shopTariffId, $cityId, $addressId, $pvz);
        }
        $product = $this->provider->buildCertificate($certificate, $this->points);
        $this->offsetSet($certificateId, $product);

        return $product;
    }

    /**
     * @param string $id
     * @param string $optionId
     * @param int    $quantity
     * @param int    $price
     * @param string $pointId
     * @param string $shopId
     * @param string $shopTariffId
     * @param string $cityId
     * @param string $addressId
     * @param string $pvz
     * @return Products\Option
     * @throws \Exception
     */
    public function addOption($id, $optionId, $quantity = 1, $price = null, $pointId = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = null)
    {
        if($pointId) {
            try {
                $this->points->get($pointId);
            } catch(\Exception $e) {
                $pointId = null;
            }
        }
        if($this->options->offsetExists($id)) {
            $option = $this->options->offsetGet($id);

            $option = $this->options->edit($id, $quantity + $option->quantity, $pointId, $shopId, $shopTariffId, $cityId, $addressId, $pvz);
        } else {
            if($price === null) {
                $option = $this->provider->loadOption($optionId);
                $price  = $option->price;
            }

            $option = $this->options->add($optionId, $quantity, $price, $pointId, $shopId, $shopTariffId, $cityId, $addressId, $pvz);
        }
        $product = $this->provider->buildOption($option, $this->points);
        $this->offsetSet($optionId, $product);

        return $product;
    }

    /**
     * @return Products\Product[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    public function clear()
    {
        $this->options->clear();
        $this->certificates->clear();
    }

    /**
     * @param $id
     * @return Products\Product
     */
    public function get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * @return \Meling\Cart\Providers\Provider
     */
    public function provider()
    {
        return $this->provider;
    }

    public function quantity()
    {
        if($this->quantity === null) {
            $this->quantity = 0;
            foreach($this->asArray() as $product) {
                $this->quantity += $product->quantity();
            }
        }

        return $this->quantity;
    }

    /**
     * @param string $id
     */
    public function removeCertificate($id)
    {
        $this->certificates->remove($id);
        $this->offsetUnset($id);
    }

    /**
     * @param string $id
     */
    public function removeOption($id)
    {
        $this->options->remove($id);
        $this->offsetUnset($id);
    }

    public function totals()
    {
        if($this->totals === null) {
            $this->totals = new Totals($this, $this->provider->actionsAfter(), $this->provider->cards()->get(), $this->provider->actions()->get());
        }

        return $this->totals;
    }

}
