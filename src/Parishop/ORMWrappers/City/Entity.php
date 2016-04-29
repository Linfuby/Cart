<?php

namespace Parishop\ORMWrappers\City;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property string                                                                regionId
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $region
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $addresses
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $shops
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $vacancies
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orders
 * @method \Parishop\ORMWrappers\Region\Entity region()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable addresses()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable shops()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable vacancies()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable orders()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    public function shops_rests($rests = true, $pickup_point = 0)
    {
        /**
         * @var \Parishop\ORMWrappers\Shop\Query     $shops_query
         * @var \Parishop\ORMWrappers\ShopRest\Query $shops_rests
         */
        $shops_query = $this->shops->query();
        $shops_query->ordering();
        if($rests) {
            $shops_query->relatedTo('shopRests');
        }
        $shops_query->where('active', 1)->where('hidden', 0);
        if($pickup_point) {
            $shops_query->where('pickup_point', $pickup_point);
        }

        return $shops_query->find();
    }

    public function shops_vision()
    {
        /**
         * @var \PHPixie\ORM\Drivers\Driver\PDO\Query $query
         */
        $query = $this->shops->query();

        return $query->where('active', 1)->where('hidden', 0)->find();
    }

}
