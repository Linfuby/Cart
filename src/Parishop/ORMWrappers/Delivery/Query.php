<?php

namespace Parishop\ORMWrappers\Delivery;

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
     * Сортировка. По умолчанию: По идентификатору По возрастанию
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'id', $orderDir = 'asc')
    {
        return parent::ordering($ordering, $orderDir);
    }

}
