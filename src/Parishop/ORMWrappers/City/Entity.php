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
    /**
     * @var \Parishop\ORMWrappers\Shop\Entity[]
     */
    protected $visibleShops;

    public function shops_rests($rests = true, $pickup_point = 0)
    {
        /**
         * @var \Parishop\ORMWrappers\Shop\Query       $shops_query
         * @var \Parishop\ORMWrappers\RestOption\Query $shops_rests
         */
        $shops_query = $this->shops->query();
        $shops_query->ordering();
        if($rests) {
            $shops_query->relatedTo('restOptions');
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

    /**
     * @param array|string $url
     * @param array        $query
     * @param string       $resolverPath
     * @return \PHPixie\HTTP\Messages\URI|\Psr\Http\Message\UriInterface
     */
    public function url($url = array(), $query = array(), $resolverPath = 'app.cities')
    {
        return parent::url(
            array_merge(
                array(
                    'cityId'        => $this->id(),
                    'service'       => null,
                    'categoryAlias' => null,
                ), $url
            ), $query, $resolverPath
        );
    }

    public function vendorShops($vendors = array())
    {
        if($this->visibleShops === null) {
            /** @var \PHPixie\ORM\Drivers\Driver\PDO\Query $query */
            $query = $this->shops->query();
            $query->relatedTo('vendor', $vendors);
            $query->where('publish', 1);
            $this->visibleShops = $query->where('active', 1)->where('hidden', 0)->find();
        }

        return $this->visibleShops;
    }

    public function visibleShops()
    {
        if($this->visibleShops === null) {
            /** @var \PHPixie\ORM\Drivers\Driver\PDO\Query $query */
            $query = $this->shops->query();
            $query->where('publish', 1);
            $this->visibleShops = $query->where('active', 1)->where('hidden', 0)->find();
        }

        return $this->visibleShops;
    }

}
