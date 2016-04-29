<?php
namespace Parishop\ORMWrappers\Filter;

/**
 * Class Entity
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $sex
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\One\Property\Entity        $category
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $categories
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $types
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $brands
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $seasons
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $sizes
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $girths
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $colors
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $values
 * @method \Parishop\ORMWrappers\Sex\Entity sex()
 * @method \Parishop\ORMWrappers\Category\Entity category()
 * @method \Parishop\ORMWrappers\Category\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable categories()
 * @method \Parishop\ORMWrappers\ProductType\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable types()
 * @method \Parishop\ORMWrappers\Brand\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable brands()
 * @method \Parishop\ORMWrappers\Season\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable seasons()
 * @method \Parishop\ORMWrappers\Size\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable sizes()
 * @method \Parishop\ORMWrappers\Girth\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable girths()
 * @method \Parishop\ORMWrappers\Color\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable colors()
 * @method \Parishop\ORMWrappers\AttributeValue\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable values()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
