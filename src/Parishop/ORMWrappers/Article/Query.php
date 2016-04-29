<?php

namespace Parishop\ORMWrappers\Article;

/**
 * Class Query
 * @method Entity load($id, $preload = true)
 * @method Entity alias($alias)
 * @method Entity findOne($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    /**
     * @return $this
     */
    public function order()
    {
        $this->query->orderAscendingBy('ordering');

        return $this;
    }
}
