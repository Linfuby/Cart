<?php
namespace Parishop\ORMWrappers\ArticleComment;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   articleId
 * @property int                                                                   articleCommentId
 * @property int                                                                   customerId
 * @property int                                                                   isDeleted
 * @property string                                                                comment
 * @property string                                                                created
 * @property string                                                                modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $parent
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $children
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $customer
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $article
 * @method \Parishop\ORMWrappers\ArticleComment\Entity parent()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable children()
 * @method \Parishop\ORMWrappers\Customer\Entity customer()
 * @method \Parishop\ORMWrappers\Article\Entity article()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
