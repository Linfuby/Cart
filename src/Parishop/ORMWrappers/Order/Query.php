<?php
namespace Parishop\ORMWrappers\Order;

/**
 * Class Query
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @method Entity[] find($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    public function preload($preload = array())
    {
        return parent::preload(array('orderStatus'));
    }

}
