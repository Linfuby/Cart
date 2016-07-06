<?php
namespace Parishop\ORMWrappers\Filter;

/**
 * Class Entity
 * @property int                                                                   sexId
 * @property mixed                                                                 categoryId
 * @property int                                                                   price
 * @property int                                                                   priceFrom
 * @property int                                                                   priceTo
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\One\Property\Entity        $defaultCategory
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $sex
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $categories
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $types
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $city
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $shop
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $action
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $brands
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $seasons
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $sizes
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $girths
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $colors
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $values
 * @method \Parishop\ORMWrappers\Sex\Entity sex()
 * @method \Parishop\ORMWrappers\Category\Entity defaultCategory()
 * @method \Parishop\ORMWrappers\Category\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable categories()
 * @method \Parishop\ORMWrappers\ProductType\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable types()
 * @method \Parishop\ORMWrappers\Brand\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable brands()
 * @method \Parishop\ORMWrappers\Season\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable seasons()
 * @method \Parishop\ORMWrappers\Size\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable sizes()
 * @method \Parishop\ORMWrappers\Girth\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable girths()
 * @method \Parishop\ORMWrappers\Color\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable colors()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\AttributeValue\Entity[] values()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
