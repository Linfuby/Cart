<?php
namespace Parishop\ORMWrappers\CarouselProduct;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   carouselId
 * @property int                                                                   productId
 * @property int                                                                   ordering
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $carousel
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $product
 * @method \Parishop\ORMWrappers\Carousel\Entity carousel()
 * @method \Parishop\ORMWrappers\Product\Entity product()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
