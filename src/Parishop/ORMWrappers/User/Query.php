<?php

namespace Parishop\ORMWrappers\User;

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
     * Сортировка. По умолчанию: По имени По возрастанию
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'lastname', $orderDir = 'asc')
    {
        return parent::ordering($ordering, $orderDir);
    }

}
