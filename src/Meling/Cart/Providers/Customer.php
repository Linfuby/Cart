<?php
namespace Meling\Cart\Providers;

/**
 * Class Customer
 * @package Meling\Cart\Providers
 */
class Customer extends Provider
{
    /**
     * @var \Parishop\ORMWrappers\Customer\Entity
     */
    protected $customer;

    /**
     * Customer constructor.
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     * @param mixed                 $customerId
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context, $customerId)
    {
        parent::__construct($orm, $context);
        $this->customer = $this->orm()->query('customer')->in($customerId)->findOne(
            array(
                'cartOptions.option.product.productImages',
                'cartOptions.option.product.brand',
                'cartOptions.option.restOptions.shop.shopTariffs.delivery',
                'cartCertificates.certificate',
                'customerCards',
                'addresses.city.region.country',
            )
        );
    }

    public function addCertificate(
        $certificateId,
        $quantity = 1,
        $price = null,
        $shopId = null,
        $deliveryId = null,
        $shopTariffId = null,
        $addressId = null,
        $pvz = null
    ) {
        /** @var \Parishop\ORMWrappers\Option\Entity $option */
        $certificate = $this->orm()->query('certificate')->in($certificateId)->findOne();
        if($certificate) {
            /** @var \Parishop\ORMWrappers\CartCertificate\Entity $cartCertificate */
            $cartCertificate               = $this->orm()->createEntity('cartCertificate');
            $cartCertificate->quantity     = $quantity;
            $cartCertificate->price        = $price;
            $cartCertificate->shopId       = $shopId;
            $cartCertificate->deliveryId   = $deliveryId;
            $cartCertificate->shopTariffId = $shopTariffId;
            $cartCertificate->addressId    = $addressId;
            $cartCertificate->pvz          = $pvz;
            $cartCertificate->save();
            $cartCertificate->certificate->set($certificate);
            $this->customer->cartCertificates->add($cartCertificate);
            $this->certificates[$cartCertificate->id()] = $this->buildProduct(
                $cartCertificate->id(),
                $cartCertificate->certificate(), $quantity, $price, 0, $cartCertificate->certificate()->name,
                $cartCertificate->certificate()->image, '', $shopId, $deliveryId, $shopTariffId, $addressId, $pvz
            );
        }
    }

    public function addOption(
        $optionId,
        $quantity = 1,
        $price = null,
        $shopId = null,
        $deliveryId = null,
        $shopTariffId = null,
        $addressId = null,
        $pvz = null
    ) {
        /** @var \Parishop\ORMWrappers\Option\Entity $option */
        $option = $this->orm()->query('option')->in($optionId)->findOne();
        if($option) {
            /** @var \Parishop\ORMWrappers\CartOption\Entity $cartOption */
            $cartOption               = $this->orm()->createEntity('cartOption');
            $cartOption->quantity     = $quantity;
            $cartOption->price        = $price;
            $cartOption->shopId       = $shopId;
            $cartOption->deliveryId   = $deliveryId;
            $cartOption->shopTariffId = $shopTariffId;
            $cartOption->addressId    = $addressId;
            $cartOption->pvz          = $pvz;
            $cartOption->save();
            $cartOption->option->set($option);
            $this->customer->cartOptions->add($cartOption);
            $this->options[(string)$cartOption->id()] = $this->buildProduct(
                $cartOption->id(), $cartOption->option(),
                $quantity, $price, $cartOption->option()->old_price,
                $cartOption->option()->product()->name(), $cartOption->option()->product()->image()->name(),
                $cartOption->option()->product()->brand()->name(), $shopId, $deliveryId, $shopTariffId, $addressId, $pvz
            );
        }
    }

    public function address()
    {
        return $this->customer->address();
    }

    public function addresses()
    {
        return $this->customer->addresses()->asArray(false, 'id');
    }

    /**
     * @return \Meling\Cart\Products\Product[]
     */
    public function certificates()
    {
        if($this->certificates === null) {
            $this->certificates = array();
            foreach($this->customer->cartCertificates() as $cartCertificate) {
                $quantity                                   = (int)$cartCertificate->quantity;
                $price                                      = (int)$cartCertificate->price;
                $shopId                                     = $cartCertificate->shopId;
                $deliveryId                                 = $cartCertificate->deliveryId;
                $shopTariffId                               = $cartCertificate->shopTariffId;
                $addressId                                  = $cartCertificate->addressId;
                $pvz                                        = $cartCertificate->pvz;
                $this->certificates[$cartCertificate->id()] = $this->buildProduct(
                    $cartCertificate->id(),
                    $cartCertificate->certificate(), $quantity, $price, 0, $cartCertificate->certificate()->name,
                    $cartCertificate->certificate()->image, '', $shopId, $deliveryId, $shopTariffId, $addressId, $pvz
                );
            }
        }

        return $this->certificates;
    }

    public function clear()
    {
        $this->customer->cartCertificates->query()->delete();
        $this->customer->cartOptions->query()->delete();
    }

    public function customerCards()
    {
        return $this->customer->customerCards();
    }

    public function editCertificate($id, $certificateId, $quantity, $price, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz)
    {
        $this->orm()->query('cartCertificate')->in($id)->update(
            array(
                'quantity'     => $quantity,
                'price'        => $price,
                'shopId'       => $shopId,
                'deliveryId'   => $deliveryId,
                'shopTariffId' => $shopTariffId,
                'addressId'    => $addressId,
                'pvz'          => $pvz,
            )
        );
    }

    public function editOption($id, $optionId, $quantity, $price, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz)
    {
        $this->orm()->query('cartOption')->in($id)->update(
            array(
                'quantity'     => $quantity,
                'price'        => $price,
                'shopId'       => $shopId,
                'deliveryId'   => $deliveryId,
                'shopTariffId' => $shopTariffId,
                'addressId'    => $addressId,
                'pvz'          => $pvz,
            )
        );
    }

    public function email()
    {
        return $this->customer->email;
    }

    public function firstname()
    {
        return $this->customer->firstname;
    }

    public function id()
    {
        return $this->customer->id();
    }

    public function lastname()
    {
        return $this->customer->lastname;
    }

    public function middlename()
    {
        return $this->customer->middlename;
    }

    /**
     * @return \Meling\Cart\Products\Product[]
     */
    public function options()
    {
        if($this->options === null) {
            $this->options = array();
            foreach($this->customer->cartOptions() as $cartOption) {
                $quantity                                 = (int)$cartOption->quantity;
                $price                                    = (int)$cartOption->price;
                $shopId                                   = $cartOption->shopId;
                $deliveryId                               = $cartOption->deliveryId;
                $shopTariffId                             = $cartOption->shopTariffId;
                $addressId                                = $cartOption->addressId;
                $pvz                                      = $cartOption->pvz;
                $this->options[(string)$cartOption->id()] = $this->buildProduct(
                    $cartOption->id(), $cartOption->option(),
                    $quantity, $price, $cartOption->option()->old_price,
                    $cartOption->option()->product()->name(), $cartOption->option()->product()->image()->name(),
                    $cartOption->option()->product()->brand()->name(), $shopId, $deliveryId, $shopTariffId, $addressId, $pvz
                );
            }
        }

        return $this->options;
    }

    public function phone()
    {
        return $this->customer->phone;
    }

    public function removeCertificate($id)
    {
        $this->orm()->query('cartCertificate')->in($id)->delete();
    }

    public function removeOption($id)
    {
        $this->orm()->query('cartOption')->in($id)->delete();
    }

}
