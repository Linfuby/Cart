<?php

namespace Parishop\ORMWrappers\Question;

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
     * Сортировка. По умолчанию: По ответу По возрастанию, По дате создания По убыванию, По дате изменения По убыванию
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'modified', $orderDir = 'desc')
    {
        $this->query->orderAscendingBy('reply');
        $this->query->orderDescendingBy('created');

        return parent::ordering($ordering, $orderDir);
    }

}
