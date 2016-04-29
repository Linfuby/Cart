<?php

namespace Parishop\ORMWrappers\Category;

/**
 * Class Query
 * @method Entity alias($alias)
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    /**
     * @return \PHPixie\Database\Result
     */
    public function tree()
    {
        return $this->where('depth', 0)->where('publish', 1)->find(array('children'));
    }
}
