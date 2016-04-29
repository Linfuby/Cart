<?php
namespace Parishop\ORMWrappers\CartCertificate;

/**
 * Сущность Корзины покупателей
 * @property string id
 * @property string customerId
 * @property string certificateId
 * @property string shopId
 * @property string deliveryId
 * @property string shopTariffId
 * @property string addressId
 * @property string pvz
 * @property string image
 * @property int    price
 * @property int    quantity
 * @property string created
 * @property string modified
 * @method \Parishop\ORMWrappers\Customer\Entity customer()
 * @method \Parishop\ORMWrappers\Certificate\Entity certificate()
 * @method \Parishop\ORMWrappers\Shop\Entity shop()
 * @method \Parishop\ORMWrappers\ShopTariff\Entity shopTariff()
 * @method \Parishop\ORMWrappers\Address\Entity address()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
