<?php
namespace Meling\Cart\Providers\Options;

/**
 * Class Customer
 * @method \PHPixie\ORM\Wrappers\Type\Database\Entity[] asArray()
 * @package Meling\Cart\Providers\Options
 */
class Customer extends \Meling\Cart\Providers\Options
{
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $customer;

    /**
     * @var \PHPixie\ORM\Loaders\Loader
     */
    protected $cartOptions;

    /**
     * Options constructor.
     * @param \PHPixie\ORM                               $orm
     * @param \PHPixie\HTTP\Context                      $context
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $customer
     * @param \PHPixie\ORM\Loaders\Loader                $cartOptions
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context, $customer, $cartOptions)
    {
        parent::__construct($cartOptions->asArray(false, 'id'), $orm, $context);
        $this->customer    = $customer;
        $this->cartOptions = $cartOptions;
    }

    public function add($optionId, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        try {
            /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $cartOption */
            $cartOption = $this->orm->createEntity('cartOption');
            $cartOption->setField('customerId', $this->customer->id());
            $cartOption->setField('optionId', $optionId);
            $cartOption->setField('price', $price);
            $cartOption->setField('quantity', $quantity);
            $cartOption->setField('shopId', $shopId);
            $cartOption->setField('deliveryId', $deliveryId);
            $cartOption->setField('shopTariffId', $shopTariffId);
            $cartOption->setField('addressId', $addressId);
            $cartOption->setField('pvz', $pvz);
            $cartOption->setField('modified', date('Y-m-d H:i:s'));
            $cartOption->save();
            $option         = $cartOption->asObject();
            $option->option = $this->load($optionId);
            $this->offsetSet($option->id, $option);
        } catch(\Exception $e) {

        }
    }

    public function clear()
    {
        $this->orm->query('cartOption')->where('customerId', $this->customer->id())->delete();
        parent::exchangeArray(array());
    }

    public function edit($id, $price, $quantity = 1, $actionId = null, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        $this->offsetGet($id);
        /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $cartOption */
        $this->orm->query('cartOption')->in($id)->update(
            array(
                'price'        => $price,
                'quantity'     => $quantity,
                'shopId'       => $shopId,
                'deliveryId'   => $deliveryId,
                'shopTariffId' => $shopTariffId,
                'addressId'    => $addressId,
                'pvz'          => $pvz,
                'modified'     => date('Y-m-d H:i:s'),
            )
        );
        $cartOption     = $this->orm->query('cartOption')->in($id)->findOne();
        $option         = $cartOption->asObject();
        $option->option = $this->load($id);
        $this->offsetSet($option->id, $option);
    }

    public function remove($id)
    {
        $this->orm->query('cartOption')->in($id)->where('customerId', $this->customer->id())->delete();
        $this->offsetUnset($id);
    }

}
