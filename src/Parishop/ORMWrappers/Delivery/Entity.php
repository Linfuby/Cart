<?php

namespace Parishop\ORMWrappers\Delivery;

/**
 * Class Entity
 * @property int                                                        id
 * @property string                                                     name
 * @property string                                                     alias
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity $shops
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable shops()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
