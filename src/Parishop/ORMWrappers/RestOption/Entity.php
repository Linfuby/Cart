<?php
namespace Parishop\ORMWrappers\RestOption;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   shopId
 * @property int                                                                   productId
 * @property int                                                                   optionId
 * @property int                                                                   quantity
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $option
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $product
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $shop
 * @method \Parishop\ORMWrappers\Option\Entity option()
 * @method \Parishop\ORMWrappers\Product\Entity product()
 * @method \Parishop\ORMWrappers\Shop\Entity shop()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
