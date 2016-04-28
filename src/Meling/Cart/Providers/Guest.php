<?php
namespace Meling\Cart\Providers;

/**
 * Class Guest
 * @package Meling\Cart\Providers
 */
class Guest extends \Meling\Cart\Providers\Provider
{
    public function certificates()
    {
        if($this->certificates === null) {
            $this->certificates = array();
            foreach($this->session()->get('certificates', array()) as $certificate) {
                if(!empty($certificate['certificateId'])) {
                    $entity = $this->orm()->query('certificate')->in($certificate['certificateId'])->findOne();
                    if($entity) {
                        $id                      = count($this->options);
                        $quantity                = empty($option['quantity']) ? 1 : (int)$option['quantity'];
                        $price                   = empty($option['price']) ? $entity->getField('price') : (int)$option['price'];
                        $shopId                  = empty($option['shopId']) ? null : $option['shopId'];
                        $shopTariffId            = empty($option['shopTariffId']) ? null : $option['shopTariffId'];
                        $addressId               = empty($option['addressId']) ? null : $option['addressId'];
                        $this->certificates[$id] = new Product($id, $entity, $quantity, $price, $shopId, $shopTariffId, $addressId);
                    }
                }
            }
        }

        return $this->certificates;
    }

    public function customer()
    {
        if($this->customer === null) {
            $this->customer = new Customer();
        }

        return $this->customer;
    }

    public function options()
    {
        if($this->options === null) {
            $this->options = array();
            foreach($this->session()->get('options', array()) as $option) {
                if(!empty($option['optionId'])) {
                    $entity = $this->orm()->query('option')->in($option['optionId'])->findOne();
                    if($entity) {
                        $id                 = count($this->options);
                        $quantity           = empty($option['quantity']) ? 1 : (int)$option['quantity'];
                        $price              = empty($option['price']) ? $entity->getField('price') : (int)$option['price'];
                        $shopId             = empty($option['shopId']) ? null : $option['shopId'];
                        $shopTariffId       = empty($option['shopTariffId']) ? null : $option['shopTariffId'];
                        $addressId          = empty($option['addressId']) ? null : $option['addressId'];
                        $this->options[$id] = new Product($id, $entity, $quantity, $price, $shopId, $shopTariffId, $addressId);
                    }
                }
            }
        }

        return $this->options;
    }


}
