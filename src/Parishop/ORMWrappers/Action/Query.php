<?php

namespace Parishop\ORMWrappers\Action;

use PHPixie\Database\Type\SQL\Expression;

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
    public function actual($actual_date)
    {
        $this->between($actual_date);
        $this->always();

        return $this;
    }

    public function actualFilter($filter = array())
    {
        $this->startAndGroup();
        $this->andWhere('date_start', '<=', new Expression('NOW()'));
        $this->andWhere('date_end', '>=', new Expression('NOW()'));
        $this->orWhere('date_end', '0000-00-00 00:00:00');
        $this->orWhere('date_end', null);
        foreach($filter as $key => $value) {
            if(strstr($key, ' ')) {
                list($key, $logic) = explode(' ', $key);
                $this->where($key, $logic, $value);
            } else {
                $this->where($key, $value);
            }
        }

        return $this;
    }

    /**
     * @param      $publish
     * @param      $dateActions
     * @param bool $assortments
     * @return $this
     */
    public function getActions($publish, $dateActions, $assortments = false)
    {
        if($publish !== null) {
            $this->where('publish', (int)$publish);
        }
        if($dateActions instanceof \DateTime) {
            $this->where('date_start', '<=', $dateActions->format('Y-m-d H:i:s'));
            $this->where('date_end', '>=', $dateActions->format('Y-m-d H:i:s'));
        } else {
            $this->startAndGroup();
            $this->orWhere('date_end', null);
            $this->orWhere('date_end', '0000-00-00 00:00:00');
            $this->endGroup();
        }
        if($assortments) {
            $this->where('actionTypeId', 53001);
        } else {
            $this->whereNot('actionTypeId', 53001);
        }

        return $this;
    }

    /**
     * Сортировка. По умолчанию: Действующие, Постоянные, Завершившиеся
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'name', $orderDir = 'asc')
    {
        $this->clearOrderBy();
        $ordering = 'CASE WHEN date_end = \'0000-00-00 00:00:00\' OR date_end IS NULL THEN NOW() WHEN date_start > NOW() THEN \'9999-99-99 99:99:99\' ELSE date_end END DESC, date_end';

        return parent::ordering(new Expression($ordering), 'asc');
    }

    /**
     * Список акций для расчета Корзины
     * @param array $types
     * @return \PHPixie\ORM\Loaders\Loader\Proxy\Caching
     */
    public function rewards($types = array())
    {
        if($types) {
            $this->where('actionTypeId', 'in', $types);
        }
        $this->where('publish', 1);
        $this->startGroup();
        $this->between();
        $this->always();
        $this->endGroup();
        $this->ordering();

        return $this->find();
    }

    /**
     * Проверка существования акции
     * @param string $actionId
     * @return \Parishop\ORMWrappers\Action\Entity
     * @throws \Exception
     */
    public function validate($actionId)
    {
        if(empty($actionId)) {
            throw new \Exception('Отсутствует actionId: ' . $actionId);
        }
        $entity = $this->in($actionId)->findOne();
        if(!$entity) {
            throw new \Exception('Не найдена акция: ' . $actionId);
        }

        return $entity;
    }

    /**
     * Фильтр по постоянным акциям
     */
    protected function always()
    {
        $this->orWhere('date_end', '0000-00-00 00:00:00');
        $this->orWhere('date_end', null);
    }

    /**
     * Фильтр по диапазону дат
     * @param \DateTime $actual_date
     * @return $this
     */
    protected function between($actual_date = null)
    {
        $this->startGroup();
        if($actual_date) {
            $this->where('date_start', '<=', $actual_date->format(DATE_W3C));
            $this->where('date_end', '>=', $actual_date->format(DATE_W3C));
        } else {
            $this->where('date_start', '<=', new Expression('NOW()'));
            $this->where('date_end', '>=', new Expression('NOW()'));
        }
        $this->endGroup();

        return $this;
    }

}
