<?php
namespace Parishop\ORMWrappers\ActionProduct;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   actionId
 * @property int                                                                   productId
 * @property int                                                                   optionId
 * @property int                                                                   discount
 ***********************************************************************************************************************
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $action
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $product
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $option
 * @method \Parishop\ORMWrappers\Action\Entity action()
 * @method \Parishop\ORMWrappers\Product\Entity product()
 * @method \Parishop\ORMWrappers\Option\Entity option()
 ***********************************************************************************************************************
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
