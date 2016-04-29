<?php
namespace Parishop\ORMWrappers\OrderHistory;

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
     * Сортировка. По умолчанию: По дате создания По убыванию
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'created', $orderDir = 'desc')
    {
        return parent::ordering($ordering, $orderDir);
    }

}
