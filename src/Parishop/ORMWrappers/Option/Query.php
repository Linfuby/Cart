<?php
namespace Parishop\ORMWrappers\Option;

/**
 * Class Query
 * @method Entity load($id, $preload = array())
 * @method Entity findOne($preload = array())
 * @method Repository repository()
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{

    public function sale()
    {
        $this->query->where('old_price', '>', 0);
        $this->query->where('special', 1);

        return $this;
    }

    /**
     * Проверка существования опции товара
     * @param $optionId
     * @return \Parishop\ORMWrappers\Option\Entity
     * @throws \Exception
     */
    public function validate($optionId)
    {
        if(empty($optionId)) {
            throw new \Exception('Отсутствует shopId: ' . $optionId);
        }
        $this->in($optionId);
        $entity = $this->findOne();
        if(!$entity) {
            throw new \Exception('Не найдена опция товара: ' . $optionId);
        }

        return $entity;
    }

    public function preload($preload = array())
    {
        return array_merge($preload, array('size', 'girth'));
    }

}
