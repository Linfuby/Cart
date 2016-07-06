<?php
namespace Parishop\ORMWrappers\OrderStatus;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orders
 * @method \Parishop\ORMWrappers\Order\Entity[] orders()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
