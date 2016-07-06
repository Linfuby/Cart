<?php
namespace Parishop\ORMWrappers\OrderOption;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   orderId
 * @property int                                                                   customerId
 * @property int                                                                   optionId
 * @property int                                                                   shopId
 * @property int                                                                   deliveryId
 * @property int                                                                   shopTariffId
 * @property int                                                                   addressId
 * @property int                                                                   pvz
 * @property string                                                                name
 * @property string                                                                par
 * @property int                                                                   quantity
 * @property int                                                                   price
 * @property int                                                                   total
 * @property int                                                                   final
 * @property int                                                                   actionId
 * @property string                                                                created
 * @property string                                                                modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $option
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $order
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $user
 * @method \Parishop\ORMWrappers\Order\Entity order()
 * @method \Parishop\ORMWrappers\Option\Entity option()
 * @method \Parishop\ORMWrappers\User\Entity user()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
