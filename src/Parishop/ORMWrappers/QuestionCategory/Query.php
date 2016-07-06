<?php
namespace Parishop\ORMWrappers\QuestionCategory;

/**
 * Class Query
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    public function main()
    {
        $this->query->where('main', 1);

        return $this;
    }

    /**
     * Сортировка. По умолчанию: По имени По возрастанию
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'id', $orderDir = 'asc')
    {
        return parent::ordering($ordering, $orderDir);
    }

    public function right($without_main = false)
    {
        if($without_main) {
            $this->query->whereNot('main', 1);
        }
        $this->query->andNotIn(array(1));

        return $this;
    }

}
