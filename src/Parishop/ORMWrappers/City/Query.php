<?php

namespace Parishop\ORMWrappers\City;

use PHPixie\Database\Type\SQL\Expression;

/**
 * Class Query
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    protected $alphabet;

    protected $cities;

    /**
     * Список городов отсортированные по алфавиту
     * @return array
     */
    public function alphabet()
    {
        if($this->alphabet === null) {
            $this->alphabet = array();
            $group_cities   = array();
            $alphabet       = 'А';
            foreach($this->cities() as $city) {
                $alphabet_city = mb_substr($city->name, 0, 1, 'UTF-8');
                if($alphabet_city != $alphabet) {
                    $this->alphabet[$alphabet] = $group_cities;
                    $group_cities              = array();
                }
                $group_cities[] = $city;
                $alphabet       = $alphabet_city;
            }
            $this->alphabet[$alphabet] = $group_cities;
        }

        return $this->alphabet;
    }

    /**
     * Список городов
     * @param int $countryId
     * @return \PHPixie\Database\Result
     */
    public function cities($countryId = 1123001)
    {
        if($this->cities === null) {
            /**
             * @var \PHPixie\Database\Driver\PDO\Query\Type\Select $query
             */
            $query = $this->appBuilder->components()->database()->get()->selectQuery();
            $query->fields(array($this->table . '.id', $this->table . '.name', 'issetShops' => 'shops.id'));
            $query->table($this->table);
            $query->join($this->table('shop'), null, 'left');
            $query->on($this->table . '.id', 'shops.cityId');
            $query->on('shops.publish', new Expression(1));
            $query->on('shops.active', new Expression(1));
            $query->on('shops.hidden', new Expression(0));
            $query->join($this->table('region'), null, 'left');
            $query->on($this->table . '.regionId', 'regions.id');
            $query->join($this->table('country'), null, 'left');
            $query->on('regions.countryId', 'countries.id');
            $query->where('countries.id', $countryId);
            $query->whereNot($this->table . '.name', null);
            $query->whereNot($this->table . '.name', '');
            $query->groupBy($this->table . '.id');
            $query->orderAscendingBy($this->table . '.name');
            $this->cities = $query->execute();
        }

        return $this->cities;
    }

    public function preload($preload = array())
    {
        return parent::preload(array('region'));
    }
}
