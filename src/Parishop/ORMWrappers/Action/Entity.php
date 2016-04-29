<?php

namespace Parishop\ORMWrappers\Action;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                actionTypeId
 * @property string                                                                name
 * @property string                                                                image
 * @property string                                                                description
 * @property string                                                                conditions
 * @property string                                                                using
 * @property string                                                                date_start
 * @property string                                                                date_end
 * @property string                                                                week
 * @property int                                                                   with_card
 * @property int                                                                   price_flag
 * @property int                                                                   discount
 * @property int                                                                   count
 * @property int                                                                   mode
 * @property int                                                                   after
 * @property int                                                                   publish
 * @property int                                                                   ordering
 * @property string                                                                created
 * @property string                                                                modified
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
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $actionType
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $actionProducts
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $bannerImages
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orders
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $products
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $options
 * @method \Parishop\ORMWrappers\ActionType\Entity actionType()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\ActionProduct\Entity[] actionProducts()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\BannerImage\Entity[] bannerImages()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\Order\Entity[] orders()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\Option\Entity[] options()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\Product\Entity[] products()
 ***********************************************************************************************************************
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\EntitySemantic
{
    /**
     * @type array
     */
    protected $action_prices = array();

    /**
     * Проверка, можно ли давать скидку товару.
     * Условия:
     * price_flag == 0: Только для товаров без спец. цен
     * price_flag == 1: Для любых товаров
     * price_flag == 2: Только для товаров со спец. ценами
     * @param bool $special
     * @return bool
     */
    public function accessSpecial($special)
    {
        // Только для товаров без спец. цены
        if($this->price_flag == 0 && $special) {
            return false;
        }
        // Только для товаров со спец. ценой
        if($this->price_flag == 2 && !$special) {
            return false;
        }

        return true;
    }

    /**
     * Возвращает действует ли акция на указанную дату
     * @param \DateTime $date
     * @return bool
     */
    public function actual($date = null)
    {
        if($date == null) {
            $date = new \DateTime();
        }
        // Если Акция имеет ограниченный срок действия
        if($this->date_end && $this->date_end != '0000-00-00 00:00:00' && $this->date_start != '0000-00-00 00:00:00') {
            $dateStart = new \DateTime($this->date_start);
            $dateEnd   = new \DateTime($this->date_end);
            if($date->format(DATE_W3C) < $dateEnd->format(DATE_W3C) && $date->format(DATE_W3C) > $dateStart->format(
                    DATE_W3C
                )
            ) {
                return true;
            }
            // Или Акция не имеет срока окончания
        } elseif($this->date_end == '0000-00-00 00:00:00' || is_null($this->date_end)) {
            return true;
        }

        // Иначе Считаем Акцию недействующей
        return false;
    }

    /**
     * @param string $format
     * @return string
     */
    public function date_end($format = null)
    {
        if($this->date_end) {
            if($format === null) {
                return $this->builder->components()->date($this->date_end, 'string');
            } else {
                return $this->builder->components()->date($this->date_end, $format)->render();
            }
        }

        return '';
    }

    /**
     * @param null $format
     * @return string
     */
    public function date_start($format = null)
    {
        if($this->date_start) {
            if($format === null) {
                return $this->builder->components()->date($this->date_start, 'string');
            } else {
                return $this->builder->components()->date($this->date_start, $format)->render();
            }
        }

        return '';
    }

    /**
     * Проверяет закончилась ли Акция
     * @return bool
     */
    public function finish()
    {
        if($this->date_start == '0000-00-00 00:00:00') {
            $this->date_start = null;
            $this->save();
        }
        if($this->date_end == '0000-00-00 00:00:00') {
            $this->date_end = null;
            $this->save();
        }
        if($this->date_end) {
            $dt     = new \DateTime();
            $dt_end = new \DateTime($this->date_end);
            if($dt->format(DATE_W3C) > $dt_end->format(DATE_W3C)) {
                return true;
            }
        }

        return false;
    }

    public function keywords()
    {
        return $this->builder->components()->orm()->keyword
            ->where('model', $this->modelName())
            ->where('modelId', $this->id())
            ->find();
    }

    public function productDiscount($optionId)
    {
        foreach($this->actionProducts() as $action_product) {
            if($action_product->optionId == $optionId) {
                return $action_product->discount;
            }
        }

        return 0;
    }

    /**
     * @param \PHPixie\Slice\Type\ArrayData $data
     */
    public function saveData($data)
    {
        $this->setIsNull('name', htmlentities($data->getRequired('name')));
        $this->setIsNull('description', htmlentities($data->getRequired('description')));
        $this->setIsNull('conditions', htmlentities($data->getRequired('conditions')));
        $this->setIsNull('using', htmlentities($data->getRequired('using')));
        $this->setIsNull('yandexRegionId', $data->getRequired('yandexRegionId'), 225);
        $this->setIsNull('sexId', $data->getRequired('sexId'), 3003);
        $this->setIsNull('keywordGroupId', $data->getRequired('keywordGroupId'), 1);
        $this->setIsNull('plural', $data->getRequired('plural'), 0);
        $this->setSeason($data->get('season'), $data->get('season_start'), $data->get('season_end'));
        $this->setIsNull('commercial', $data->getRequired('commercial'), 0);
        $this->setIsNull('publish', $data->getRequired('publish'), 0);
        $this->setIsNull('meta_title', htmlentities($data->getRequired('meta_title')));
        $this->setIsNull('meta_description', htmlentities($data->getRequired('meta_description')));
        $this->setIsNull('meta_keywords', htmlentities($data->getRequired('meta_keywords')));
        $this->setIsNull('og_title', htmlentities($data->getRequired('og_title')));
        $this->setIsNull('og_description', htmlentities($data->getRequired('og_description')));
        $this->setIsNull('og_image', htmlentities($data->getRequired('og_image')));
        $this->setIsNull('modified', date('Y-m-d H:i:s'));
        $this->save();
    }

    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        if($resolverPath === null) {
            $resolverPath = 'app.action';
        }

        return parent::url(
            array(
                'processor' => 'actions',
                'action'    => 'action',
                'id'        => $this->id(),
            ), $query, $resolverPath
        );
    }

    /**
     * @param $option_entity
     * @return null|\Parishop\ORMWrappers\ActionProduct\Entity
     */
    protected function getActionProduct($option_entity)
    {
        if($option_entity) {

            /**
             * Если есть опция, получаем данные по скидке для данной опции в текущей акции
             * @var \Parishop\ORMWrappers\ActionProduct\Query $action_product_query
             */
            $action_product_query  = $this->actionProducts->query();
            $action_product_entity = $action_product_query->relatedTo(
                'option', $option_entity
            )->findOne();

            return $action_product_entity;
        }

        return null;
    }

}
