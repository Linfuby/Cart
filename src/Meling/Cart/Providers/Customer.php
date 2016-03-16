<?php
namespace Meling\Cart\Providers;

/**
 * Class Customer
 * @property string id
 * @method string name()
 * @package Meling\Cart\Providers
 */
class Customer extends \Meling\Cart\Providers\Provider
{
    /**
     * @var \Parishop\ORMWrappers\Customer\Entity
     */
    protected $customer;

    /**
     * Customer constructor.
     * @param \Meling\Cart\Source                    $source
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $customer
     */
    public function __construct($source, $customer)
    {
        $this->customer = $customer;
        parent::__construct($source);
    }

    function __call($name, $arguments)
    {
        return $this->customer->{$name}($arguments);
    }

    public function __get($name)
    {
        return $this->customer->{$name};
    }

    /**
     * @param \Meling\Cart\Orders\Order\Certificates\Certificate $certificate
     */
    public function addCertificate($certificate)
    {
        /**
         * @var \Parishop\ORMWrappers\CartCertificate\Entity $entity
         */
        $query = $this->customer->cartCertificates->query();
        if($entity = $query->where('certificateId', $certificate->certificate()->id())->findOne()) {
            $entity->quantity += $certificate->quantity();
        } else {
            $entity                = $this->source()->repository('cart')->create();
            $entity->customerId    = $this->customer->id();
            $entity->certificateId = $certificate->certificate()->id();
            $entity->shopId        = $certificate->shopId;
            $entity->deliveryId    = $certificate->deliveryId;
            $entity->shopTariffId  = $certificate->shopTariffId;
            $entity->addressId     = $certificate->addressId;
            $entity->pvz           = $certificate->pvz;
            $entity->image         = $certificate->image();
            $entity->price         = $certificate->price;
            $entity->quantity      = $certificate->quantity();
        }
        $entity->modified = date('Y-m-d H:i:s');
        $entity->save();

        return $entity->id();
    }

    /**
     * @param \Meling\Cart\Orders\Order\Products\Product $product
     */
    public function addProduct($product)
    {
        /**
         * @var \Parishop\ORMWrappers\Cart\Entity $entity
         */
        $query = $this->customer->carts->query();
        if($entity = $query->where('optionId', $product->option()->id())->findOne()) {
            $entity->quantity += $product->quantity();
        } else {
            $entity               = $this->source()->repository('cart')->create();
            $entity->customerId   = $this->customer->id();
            $entity->optionId     = $product->option()->id();
            $entity->shopId       = $product->shopId;
            $entity->deliveryId   = $product->deliveryId;
            $entity->shopTariffId = $product->shopTariffId;
            $entity->addressId    = $product->addressId;
            $entity->pvz          = $product->pvz;
            $entity->price        = $product->price;
            $entity->quantity     = $product->quantity();
        }
        $entity->modified = date('Y-m-d H:i:s');
        $entity->save();

        return $entity->id();
    }

    /**
     * @return array
     */
    public function cards()
    {
        return $this->customer->customerCards()->asArray();
    }

    /**
     * @return array
     */
    public function certificates()
    {
        return $this->customer->cartCertificates()->asArray();
    }

    public function clearCertificates()
    {
        $this->customer->cartCertificates->query()->delete();
        $this->customer->cartCertificates->removeAll();
    }

    public function clearProducts()
    {
        $this->customer->carts->query()->delete();
        $this->customer->carts->removeAll();
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
        $birthday = $this->customer->getField('birthday');
        if($birthday && $birthday != '0000-00-00') {
            $birthday_use = $this->customer->getField('birthday_use');
            if($birthday_use && $birthday_use != '0000-00-00') {
                if(date('Y') == date_create_from_format('Y-m-d', $birthday_use)->format('Y')) {
                    return null;
                }
            }

            return new \DateTime($birthday);
        }

        return null;
    }

    /**
     * @return \DateTime
     */
    public function dateMarriage()
    {
        $marriage = $this->customer->getField('marriage');
        if($marriage && $marriage != '0000-00-00') {
            $marriage_use = $this->customer->getField('marriage_use');
            if($marriage_use && $marriage_use != '0000-00-00') {
                if(date('Y') == date_create_from_format('Y-m-d', $marriage_use)->format('Y')) {
                    return null;
                }
            }

            return new \DateTime($marriage);
        }

        return null;
    }

    public function id()
    {
        return $this->customer->id();
    }

    /**
     * @return array
     */
    public function products()
    {
        return $this->customer->carts()->asArray();
    }

    public function removeCertificates($id)
    {
        $this->customer->cartCertificates->query()->in($id)->delete();
        $this->customer->cartCertificates->remove($id);
    }

    public function removeProducts($id)
    {
        $this->customer->carts->query()->in($id)->delete();
        $this->customer->carts->remove($id);
    }

}
