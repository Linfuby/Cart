<?php

namespace Parishop\ORMWrappers\Address;

/**
 * Запросы Адресов покупателей
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    protected $errorNotFound = 'Адрес не найден';

    /**
     * @param array $preload
     * @return array
     */
    public function preload($preload = array())
    {
        return array_merge($preload, array('country', 'region', 'city'));
    }

}
