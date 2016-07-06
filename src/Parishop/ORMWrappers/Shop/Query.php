<?php

namespace Parishop\ORMWrappers\Shop;

/**
 * Class Query
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @method Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Editable find($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    public function pickup_point()
    {
        $this->query->where('pickup_point', 1);

        return $this;
    }

    /**
     * Проверка существования магазина
     * @param string $shopId
     * @return \Parishop\ORMWrappers\Shop\Entity
     * @throws \Exception
     */
    public function validate($shopId)
    {
        if(empty($shopId)) {
            throw new \Exception('Отсутствует shopId: ' . $shopId);
        }
        $this->in($shopId);
        $entity = $this->findOne();
        if(!$entity) {
            throw new \Exception('Не найден магазин: ' . $shopId);
        }

        return $entity;
    }

    /**
     * @return $this
     */
    public function vision()
    {
        $this->query->where('active', 1);
        $this->query->where('hidden', 0);

        return $this;
    }
    public function preload($preload = array())
    {
        return parent::preload(array('city', 'shopTariffs.delivery'));
    }

}
