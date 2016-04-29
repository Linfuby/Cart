<?php
namespace Parishop\ORMWrappers\CustomerReward;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   customerId
 * @property int                                                                   orderId
 * @property int                                                                   rewards
 * @property string                                                                created
 * @property string                                                                modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $customer
 * @method \Parishop\ORMWrappers\Customer\Entity customer()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
