<?php

namespace Parishop\ORMWrappers\Contact;

/**
 * Class Query
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    public function bottom()
    {
        $this->query->where('ordering', '>', 2);

        return $this;
    }

    /**
     * Сортировка. По умолчанию: По сортировке По возрастанию
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'ordering', $orderDir = 'asc')
    {
        return parent::ordering($ordering, $orderDir);
    }

    public function top()
    {
        $this->query->where('ordering', '<=', 2);

        return $this;
    }
}
