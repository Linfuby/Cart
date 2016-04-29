<?php
namespace Parishop\ORMWrappers\Shop;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   vendorId
 * @property int                                                                   shopTypeId
 * @property int                                                                   countryId
 * @property int                                                                   regionId
 * @property int                                                                   cityId
 * @property int                                                                   lat
 * @property int                                                                   lng
 * @property int                                                                   active
 * @property int                                                                   hidden
 * @property int                                                                   pickup_point
 * @property int                                                                   brafitting
 * @property string                                                                created
 * @property string                                                                modified
 * @property int                                                                   publish
 * @property int                                                                   ordering
 * @property string                                                                name
 * @property string                                                                description
 * @property string                                                                street
 * @property string                                                                email
 * @property string                                                                phone
 * @property string                                                                work_times
 * @property string                                                                director
 * @property string                                                                director_image
 * @property string                                                                image
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $country
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $region
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $city
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $rests
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $options
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $deliveries
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $products
 * @property  \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity           $payments
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $shopTariffs
 * @method \Parishop\ORMWrappers\Country\Entity country()
 * @method \Parishop\ORMWrappers\Region\Entity region()
 * @method \Parishop\ORMWrappers\City\Entity city()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\Option\Entity[] options()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\Delivery\Entity[] deliveries()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\Product\Entity[] products()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\ShopTariff\Entity[] shopTariffs()
 * @method \Parishop\ORMWrappers\Payment\Entity[] payments()
 ***********************************************************************************************************************
 * @property string                                                                meta_title
 * @property string                                                                meta_description
 * @property string                                                                meta_keywords
 * @property string                                                                og_title
 * @property string                                                                og_description
 * @property string                                                                og_image
 ***********************************************************************************************************************
 * @property int                                                                   keywordGroupId
 * @property int                                                                   yandexRegionId
 * @property int                                                                   sexId
 * @property int                                                                   plural
 * @property int                                                                   commercial
 * @property int                                                                   season
 * @property string                                                                season_start
 * @property string                                                                season_end
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $keywordGroup
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $yandexRegion
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $sex
 * @method \Parishop\ORMWrappers\KeywordGroup\Entity keywordGroup()
 * @method \Parishop\ORMWrappers\YandexRegion\Entity yandexRegion()
 * @method \Parishop\ORMWrappers\Sex\Entity sex()
 ***********************************************************************************************************************
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    /**
     * @var \Parishop\ORMWrappers\ShopRest\Entity[]
     */
    protected $rest;

    /**
     * TODO-Linfuby: Изменить определение метки доставки
     * @return bool
     */
    public function delivery_point()
    {
        return $this->active && $this->deliveries();
    }

    public function keywords()
    {
        return $this->builder->components()->orm()->keyword->where('model', $this->modelName())->where(
            'modelId', $this->id()
        )->find();
    }

    public function pickup_point()
    {
        return $this->publish && $this->active && !$this->hidden && $this->pickup_point;
    }

    public function rests($optionId)
    {
        $this->requireRests();
        if(array_key_exists($optionId, $this->rest)) {
            return $this->rest[$optionId]->quantity;
        }

        return 0;
    }

    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        if($resolverPath === null) {
            $resolverPath = 'app.shop';
        }

        return parent::url(
            array(
                'processor' => 'shops',
                'action'    => 'shop',
                'id'        => $this->id(),
            ), $query, $resolverPath
        );
    }

    /**
     * @return \Parishop\ORMWrappers\ShopRest\Entity
     */
    protected function requireRests()
    {
        if($this->rest === null) {
            $this->rest = $this->builder->components()->orm()->shopRest->where('shopId', $this->id())->find()->asArray(false, 'optionId');
        }

        return $this->rest;
    }
}
