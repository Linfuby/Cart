<?php
namespace Parishop\ORMWrappers\Line;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property string                                                                meta_title
 * @property string                                                                meta_description
 * @property string                                                                meta_keywords
 * @property string                                                                og_title
 * @property string                                                                og_description
 * @property string                                                                og_image
 * @property string                                                                description
 * @property string                                                                created
 * @property string                                                                modified
 * @property int                                                                   publish
 * @property int                                                                   ordering
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $products
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable products()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
