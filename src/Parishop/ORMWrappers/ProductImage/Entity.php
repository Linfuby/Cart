<?php
namespace Parishop\ORMWrappers\ProductImage;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   productId
 * @property int                                                                   tv_id
 * @property int                                                                   mainColorId
 * @property int                                                                   product_image_view_id
 * @property string                                                                name
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $product
 * @method \Parishop\ORMWrappers\Product\Entity product()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
