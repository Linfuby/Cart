<?php

namespace Parishop\ORMWrappers\Call;

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
     * Сортировка. По умолчанию: Неопубликованные По возрастанию, Созданные по убыванию
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'created', $orderDir = 'desc')
    {
        $this->query->orderAscendingBy('publish');

        return parent::ordering('created', 'desc');
    }
}
