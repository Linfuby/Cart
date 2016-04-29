<?php

namespace Parishop\ORMWrappers\Country;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $addresses
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $regions
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orders
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable addresses()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable regions()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable orders()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
