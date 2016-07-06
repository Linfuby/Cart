<?php
namespace Parishop\ORMWrappers\ArticleComment;

/**
 * Class Query
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    /**
     * @return Entity
     */
    public function create()
    {
        return $this->appBuilder->components()->orm()->repository($this->modelName())->create();
    }

}
