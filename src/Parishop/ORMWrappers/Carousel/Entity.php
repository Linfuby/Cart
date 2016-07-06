<?php

namespace Parishop\ORMWrappers\Carousel;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property int                                                                   publish
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $carouselProducts
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $products
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable carouselProducts()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable products()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
