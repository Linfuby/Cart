<?php
namespace Meling\Cart\Provider;

class Customer extends \Meling\Cart\Provider
{
    /**
     * @var \Meling\Cart\Wrappers\Customer\Entity
     */
    private $customer;

    /**
     * Order constructor.
     * @param \Meling\Cart\Wrappers\Customer\Entity $customer
     */
    public function __construct(\Meling\Cart\Wrappers\Customer\Entity $customer)
    {
        $this->customer = $customer;
    }

    protected function requireCertificates()
    {
        return $this->customer->cartCertificates()->asArray(true);
    }

    protected function requireOptions()
    {
        return $this->customer->carts()->asArray(true);
    }

}
