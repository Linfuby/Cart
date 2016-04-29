<?php

namespace Parishop\ORMWrappers\Region;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   countryId
 * @property string                                                                name
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $country
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $addresses
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orders
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable addresses()
 * @method \Parishop\ORMWrappers\Country\Entity country()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable orders()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
