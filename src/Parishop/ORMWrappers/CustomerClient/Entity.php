<?php
namespace Parishop\ORMWrappers\CustomerClient;

/**
 * Class Entity
 * @property int                                                            id
 * @property int                                                            card_id
 * @property string                                                         customerId
 * @property string                                                         firstname
 * @property string                                                         middlename
 * @property string                                                         lastname
 * @property int                                                            phone
 * @property string                                                         email
 * @property string                                                         birthday
 * @property string                                                         birthday_use
 * @property string                                                         marriage
 * @property string                                                         marriage_use
 * @property string                                                         created
 * @property string                                                         modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\One\Property\Entity $customer
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\One\Property\Entity $customerCard
 * @method \Parishop\ORMWrappers\Customer\Entity customer()
 * @method \Parishop\ORMWrappers\CustomerCard\Entity customerCard()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
