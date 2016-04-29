<?php

namespace Parishop\ORMWrappers\Page;

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
    public function sitemap()
    {
        $this->where('sitemap', 1);

        return $this;
    }

}
