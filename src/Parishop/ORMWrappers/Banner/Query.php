<?php

namespace Parishop\ORMWrappers\Banner;

/**
 * Class Query
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    public function home()
    {
        $this->in(9);
        $this->where('publish', 9);

        return $this->findOne();
    }

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
