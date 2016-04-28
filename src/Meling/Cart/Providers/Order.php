<?php
namespace Meling\Cart\Providers;

/**
 * Class Order
 * @package Meling\Cart\Providers
 */
class Order extends \Meling\Cart\Providers\Provider
{
    /**
     * @var \Meling\Tests\ORMWrappers\Entities\Order
     */
    private $order;

    /**
     * Provider constructor.
     * @param \PHPixie\ORM                               $orm
     * @param \PHPixie\HTTP\Context\Session              $session
     * @param \Meling\Tests\ORMWrappers\Entities\Order $order
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context\Session $session, $order)
    {
        parent::__construct($orm, $session);
        $this->order = $order;
    }

    public function certificates()
    {
        if($this->certificates === null) {
            $this->certificates = array();
            foreach($this->order->orderCertificates() as $certificate) {
                $this->certificates[$certificate->id()] = new Product($certificate->id(), $certificate->certificate(), $certificate->getRequiredField('quantity'), $certificate->getRequiredField('price'), $this->order->getRequiredField('shopId'), $this->order->getRequiredField('shopTariffId'), $this->order->getRequiredField('addressId'));
            }
        }

        return $this->certificates;
    }

    public function customer()
    {
        if($this->customer === null) {
            $this->customer = new Customer($this->order->customer()->id(), $this->order->customer()->getRequiredField('lastname'), $this->order->customer()->getRequiredField('firstname'), $this->order->customer()->getRequiredField('middlename'), $this->order->customer()->getRequiredField('email'), $this->order->customer()->getRequiredField('phone'), $this->order->customer()->getRequiredField('birthday'), $this->order->customer()->getRequiredField('marriage'));
        }

        return $this->customer;
    }

    public function options()
    {
        if($this->options === null) {
            $this->options = array();
            foreach($this->order->orderOptions() as $option) {
                $this->options[$option->id()] = new Product($option->id(), $option->option(), $option->getRequiredField('quantity'), $option->getRequiredField('price'), $this->order->getRequiredField('shopId'), $this->order->getRequiredField('shopTariffId'), $this->order->getRequiredField('addressId'));
            }
        }

        return $this->options;
    }


}
