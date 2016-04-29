<?php

namespace Parishop\ORMWrappers\Cart;

/**
 * Запросы Корзины покупателей
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @method Repository repository()
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    /**
     * @param array $preload
     * @return array
     */
    /*protected function preload($preload = array())
    {
        return array_merge(
            $preload, array(
                'option',
                'option.product',
                'option.product.images',
                'option.product.brand',
                'option.actions',
                'option.size',
                'option.girth',
                'option.main_color',
                'option.rests',
                'option.rests.shop',
                'option.rests.shop.city',
                'delivery',
                'shop',
                'address',
            )
        );
    }*/

}
