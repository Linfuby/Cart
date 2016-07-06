<?php
namespace Parishop\ORMWrappers\CustomerCard;

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
     * Проверка существования клубной карты
     * @param string $id
     * @return Entity
     * @throws \Exception
     */
    public function validate($id)
    {
        if(empty($id)) {
            throw new \Exception('Отсутствует CARD_ID: ' . $id);
        }
        $this->in($id);
        $entity = $this->findOne();
        if(!$entity) {
            throw new \Exception('Не найдена клубная карта: ' . $id);
        }

        return $entity;
    }

}
