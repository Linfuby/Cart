<?php
namespace Parishop\ORMWrappers\ProductType;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property string                                                                categoryId
 * @property string                                                                priceMin
 * @property string                                                                priceMax
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $category
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $products
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable products()
 * @method \Parishop\ORMWrappers\Category\Entity category()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
