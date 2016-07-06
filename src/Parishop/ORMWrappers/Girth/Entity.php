<?php
namespace Parishop\ORMWrappers\Girth;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $products
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $options
 * @method \Parishop\ORMWrappers\Product\Entity[] products()
 * @method \Parishop\ORMWrappers\Option\Entity[] options()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
