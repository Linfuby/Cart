<?php
namespace Parishop\ORMWrappers\Season;

/**
 * Class Query
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    public function last()
    {
        $this->query->where('last', 1);
        $this->query->orderDescendingBy('id');

        return $this;
    }

}
