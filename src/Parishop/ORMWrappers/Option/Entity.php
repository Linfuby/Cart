<?php
namespace Parishop\ORMWrappers\Option;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   productId
 * @property int                                                                   sizeId
 * @property string                                                                girthId
 * @property int                                                                   price
 * @property string                                                                old_price
 * @property int                                                                   special
 * @property string                                                                created
 * @property string                                                                modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $actionProducts
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $actions
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orderOptions
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $orders
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $product
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $colors
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $girth
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $size
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $restOptions
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $shops
 * @method \Parishop\ORMWrappers\ActionProduct\Entity[] actionProducts()
 * @method \Parishop\ORMWrappers\Action\Entity[] actions()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable orderOptions()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable orders()
 * @method \Parishop\ORMWrappers\Product\Entity product()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable colors()
 * @method \Parishop\ORMWrappers\Girth\Entity girth()
 * @method \Parishop\ORMWrappers\Size\Entity size()
 * @method \Parishop\ORMWrappers\RestOption\Entity[] restOptions()
 * @method \Parishop\ORMWrappers\Shop\Entity[] shops()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    protected $quantity_stock;

    protected $quantity_stock_city = array();

    protected $quantity_stock_shop = array();

    protected $action;

    /**
     * @param                       $entity
     * @param \Parishop\App\Builder $builder
     */
    public function __construct($entity, $builder)
    {
        parent::__construct($entity, $builder);
    }

    /**
     * @return \Parishop\ORMWrappers\Action\Entity
     */
    public function action()
    {
        if($this->action === null) {
            /** @var \Parishop\ORMWrappers\ActionProduct\Entity $actionDiscount */
            $actionDiscount = null;
            foreach($this->actionProducts() as $actionProduct) {
                if(!$actionDiscount || $actionProduct->discount > $actionDiscount->discount) {
                    $actionDiscount = $actionProduct;
                }
            }
            if($actionDiscount) {
                $this->action = $actionDiscount->action();
            }
        }

        return $this->action;
    }

    public function girthName()
    {
        return $this->girth() ? ' ' . $this->girth()->name() : '';
    }

    public function productDiscount($id)
    {
        foreach($this->actionProducts() as $action_product) {
            if($action_product->actionId == $id) {
                return $action_product->discount;
            }
        }

        return 0;
    }

    /**
     * @return int
     * @deprecated
     */
    public function quantity_city()
    {
        /**
         * @var \Parishop\ORMWrappers\RestOption\Query $shop_rests_query
         * @var \Parishop\ORMWrappers\City\Query       $city_query
         */
        $cityId           = $this->builder->cookies->get('city_default_id', -7915569);
        $shop_rests_query = $this->restOptions->query();
        $city_query       = $this->builder->components()->orm()->city;
        $city_query->in($cityId);
        $rests         = $shop_rests_query->relatedTo('shop.city', $city_query)->find();
        $quantity_city = 0;
        foreach($rests as $rest) {
            $quantity_city += $rest->quantity;
        }

        return $quantity_city;
    }

    /**
     * @return int
     */
    public function quantity_stock()
    {
        if(!$this->quantity_stock) {
            /**
             * @var \Parishop\ORMWrappers\RestOption\Entity $rest
             */
            foreach($this->restOptions() as $rest) {
                if(!isset($this->quantity_stock_city[$rest->shop()->city()->id()])) {
                    $this->quantity_stock_city[$rest->shop()->city()->id()] = $rest->quantity;
                } else {
                    $this->quantity_stock_city[$rest->shop()->city()->id()] += $rest->quantity;
                }
                if(!isset($this->quantity_stock_shop[$rest->shop()->id()])) {
                    $this->quantity_stock_shop[$rest->shop()->id()] = $rest->quantity;
                } else {
                    $this->quantity_stock_shop[$rest->shop()->id()] += $rest->quantity;
                }
                $this->quantity_stock += $rest->quantity;
            }
        }

        return $this->quantity_stock;
    }

    /**
     * @param \Parishop\ORMWrappers\City\Entity $city
     * @return int
     */
    public function quantity_stock_city($city = null)
    {
        if($city) {
            if(!$this->quantity_stock_city) {
                $this->quantity_stock();
            }

            return $this->quantity_stock_city[$city->id()];
        }

        return 0;
    }

    /**
     * @param \Parishop\ORMWrappers\Shop\Entity $shop
     * @return int
     */
    public function quantity_stock_shop($shop = null)
    {
        if($shop) {
            if(!$this->quantity_stock_shop) {
                $this->quantity_stock();
            }

            return $this->quantity_stock_shop[$shop->id()];
        }

        return 0;
    }

    public function sizeName()
    {
        return $this->size()->name() . $this->girthName();
    }

    public function special()
    {
        return (int)$this->special;
    }

    public function specialSuccess($price_flag)
    {
        switch((int)$price_flag) {
            case 0:
                if($this->special) {
                    return false;
                }
                break;
            case 2:
                if(!$this->special) {
                    return false;
                }
                break;
        }

        return true;
    }

}
