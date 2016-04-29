<?php
namespace Parishop\ORMWrappers\ArticleTag;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   articleId
 * @property string                                                                name
 * @property string                                                                created
 * @property string                                                                modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $article
 * @method \Parishop\ORMWrappers\Article\Entity article()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
