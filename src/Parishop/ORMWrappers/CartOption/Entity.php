<?php
namespace Parishop\ORMWrappers\CartOption;

/**
 * Сущность Корзины покупателей
 * @property int                                                                   id
 * @property int                                                                   customerId
 * @property string                                                                optionId
 * @property int                                                                   deliveryId
 * @property int                                                                   shopTariffId
 * @property string                                                                shopId
 * @property int                                                                   addressId
 * @property string                                                                pvz
 * @property int                                                                   price
 * @property int                                                                   quantity
 * @property string                                                                created
 * @property string                                                                modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $customer
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $option
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $shop
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $delivery
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $shopTariff
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $address
 * @method \Parishop\ORMWrappers\Customer\Entity customer()
 * @method \Parishop\ORMWrappers\Option\Entity option()
 * @method \Parishop\ORMWrappers\Shop\Entity shop()
 * @method \Parishop\ORMWrappers\Delivery\Entity delivery()
 * @method \Parishop\ORMWrappers\ShopTariff\Entity shopTariff()
 * @method \Parishop\ORMWrappers\Address\Entity address()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    /**
     * @param array|string $url
     * @param array        $query
     * @param string       $resolverPath
     * @return \PHPixie\HTTP\Messages\URI|\Psr\Http\Message\UriInterface
     */
    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        if($resolverPath === null) {
            $resolverPath = 'app.product';
        }

        return parent::url(
            array(
                'processor' => 'products',
                'action'    => 'product',
                'id'        => $this->option()->product()->alias,
            ), $query, $resolverPath
        );
    }

}
