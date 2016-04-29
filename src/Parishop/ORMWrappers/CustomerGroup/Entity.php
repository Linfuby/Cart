<?php
namespace Parishop\ORMWrappers\CustomerGroup;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $customers
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orders
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable customers()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable orders()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
