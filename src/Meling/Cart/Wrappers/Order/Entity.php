<?php
namespace Meling\Cart\Wrappers\Order;

/**
 * Class Entity
 * @property mixed id
 * @property mixed shopId
 * @property mixed deliveryId
 * @property mixed shopTariffId
 * @property mixed addressId
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Meling\Cart\Wrappers\OrderCertificate\Entity[] orderCertificates()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Meling\Cart\Wrappers\OrderProduct\Entity[] orderProducts()
 * @package Meling\Cart\Wrappers\Order
 */
class Entity extends \PHPixie\ORM\Wrappers\Type\Database\Entity
{

}