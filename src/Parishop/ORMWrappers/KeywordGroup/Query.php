<?php
namespace Parishop\ORMWrappers\KeywordGroup;

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
     * Сортировка. По умолчанию: По Коллекции По возрастанию, По имени По возрастанию
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'name', $orderDir = 'asc')
    {
        $this->query->orderAscendingBy('keywordCollectionId');

        return parent::ordering($ordering, $orderDir);
    }

}
