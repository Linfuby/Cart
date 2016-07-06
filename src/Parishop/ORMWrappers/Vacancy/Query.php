<?php

namespace Parishop\ORMWrappers\Vacancy;

/**
 * Class Query
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    public function getPreload()
    {
        return array('city', 'department');
    }

    /**
     * Сортировка. По умолчанию: По публикации По убыванию, По дате создания По убыванию, По имени По возрастанию
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'name', $orderDir = 'asc')
    {
        $this->query->orderDescendingBy('publish');
        $this->query->orderDescendingBy('created');

        return parent::ordering($ordering, $orderDir);
    }

}
