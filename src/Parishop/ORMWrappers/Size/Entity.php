<?php

namespace Parishop\ORMWrappers\Size;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property int                                                                   sizeRangeId
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $sizeRange
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $products
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $options
 * @method \Parishop\ORMWrappers\SizeRange\Entity sizeRange()
 * @method \Parishop\ORMWrappers\Product\Entity[] products()
 * @method \Parishop\ORMWrappers\Option\Entity[] options()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
