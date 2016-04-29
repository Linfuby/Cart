<?php

namespace Parishop\ORMWrappers\Product;

use PHPixie\Database\Type\SQL\Expression;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   tv_id
 * @property int                                                                   mainColorId
 * @property int                                                                   sexId
 * @property int                                                                   countryId
 * @property int                                                                   sizeRangeId
 * @property int                                                                   brandId
 * @property int                                                                   lineId
 * @property int                                                                   seasonId
 * @property int                                                                   productTypeId
 * @property string                                                                productPartId
 * @property int                                                                   productImageViewId
 * @property string                                                                name
 * @property string                                                                par
 * @property string                                                                art
 * @property int                                                                   weight
 * @property string                                                                material
 * @property string                                                                description
 * @property string                                                                hits
 * @property string                                                                created
 * @property string                                                                modified
 * @property int                                                                   publish
 * @property int                                                                   ordering
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $actionProducts
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $actions
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $articles
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $carousel_products
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $carousels
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $brand
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $country
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $girths
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $image_view
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $productImages
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $line
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $mainColor
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $options
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $part
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $season
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $sex
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $size_range
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $sizes
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $sub_type
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $type
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $optionsRests
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $shops
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $attributes
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $attributeValues
 * @method \Parishop\ORMWrappers\AttributeValue\Entity[] attributes()
 * @method \Parishop\ORMWrappers\AttributeValue\Entity[] attributeValues()
 * @method \Parishop\ORMWrappers\ActionProduct\Entity[] actionProducts()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\Action\Entity[] actions()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable articles()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable carousel_products()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable carousels()
 * @method \Parishop\ORMWrappers\Brand\Entity brand()
 * @method \Parishop\ORMWrappers\Country\Entity country()
 * @method \Parishop\ORMWrappers\Girth\Entity[] girths()
 * @method \Parishop\ORMWrappers\ProductImageView\Entity image_view()
 * @method \Parishop\ORMWrappers\ProductImage\Entity[] productImages()
 * @method \Parishop\ORMWrappers\Line\Entity line()
 * @method \Parishop\ORMWrappers\MainColor\Entity mainColor()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\Option\Entity[] options()
 * @method \Parishop\ORMWrappers\Option\Entity[] optionsRests()
 * @method \Parishop\Admin\HTTPProcessors\Home part()
 * @method \Parishop\ORMWrappers\Season\Entity season()
 * @method \Parishop\ORMWrappers\Sex\Entity sex()
 * @method \Parishop\ORMWrappers\SizeRange\Entity size_range()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable sizes()
 * @method \Parishop\ORMWrappers\ProductType\Entity type()
 * @method \Parishop\ORMWrappers\Shop\Entity[] shops()
 ***********************************************************************************************************************
 * @property string                                                                meta_title
 * @property string                                                                meta_description
 * @property string                                                                meta_keywords
 * @property string                                                                og_title
 * @property string                                                                og_description
 * @property string                                                                og_image
 ***********************************************************************************************************************
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    protected $option;

    public function __get($name)
    {
        switch($name) {
            case 'par':
                $par = parent::__get($name);
                if(strstr($par, '#')) {
                    return stristr($par, '#', true);
                }

                return $par;
            default:
                return parent::__get($name);
                break;
        }
    }

    /**
     * Возвращает первую акцию (По сути самую старую) в которой участвует данный товар
     * TODO-Linfuby: Необходимо найти решение если акций будет несколько.
     * @param \DateTime $date
     * @return \Parishop\ORMWrappers\Action\Entity
     */
    public function action($date = null)
    {
        /**
         * Получаем Query всех акций (manyToMany)
         * @var \Parishop\ORMWrappers\Action\Query $actions
         */
        $actions = $this->actions->query();
        /**
         * Фильтруем по публикации
         * И дате действия
         */
        $actions->where('publish', 1);
        if($date) {
            $actions->where('date_start', '<=', $date->format(DATE_W3C));
            $actions->where('date_end', '>=', $date->format(DATE_W3C));
        } else {
            $actions->where('date_start', '<=', new Expression('NOW()'));
            $actions->where('date_end', '>=', new Expression('NOW()'));
        }

        /**
         * Возвращаем только 1 акцию
         */

        return $actions->findOne();
    }

    public function brandName()
    {
        return $this->brand()->name();
    }

    /**
     * TODO-Linfuby: Вывести цену со скидкой по карте
     * @return int
     */
    public function card_price()
    {
        return null;
    }

    /**
     * TODO-Linfuby
     * @return string
     */
    public function category()
    {
        $category = $this->builder->components()->orm()->category->relatedTo('sex', $this->sexId)->findOne();

        return $category ? $category->name() : '';
    }

    /**
     * Вычисление Какую акцию применить
     * @param string                              $actionId
     * @param \Parishop\ORMWrappers\Option\Entity $option
     * @return mixed
     */
    public function getActionPrice($actionId, $option)
    {
        /**
         * @var \Parishop\ORMWrappers\ActionProduct\Query $action_product_query
         */
        if(!$actionId) {
            return $option->price;
        }
        $action_product_query = $this->builder->components()->orm()->actionProduct;
        $action_product       = $action_product_query->where('actionId', $actionId)->relatedTo(
            'option', $option
        )->findOne();
        if(!$action_product) {
            return $option->price;
        }

        return $option->price - ($option->price / 100 * $action_product->discount);
    }

    /**
     * @return \Parishop\ORMWrappers\ProductImage\Entity
     */
    public function image()
    {
        try {
            return $this->productImages()->getByOffset(0);
        } catch(\Exception $e) {
            $product_image = $this->builder->components()->orm()->createEntity('productImage');
            $product_image->setField('tv_id', $this->tv_id);
            $product_image->setField('mainColorId', $this->mainColorId);
            $product_image->setField('productImageViewId', $this->productImageViewId);
            $product_image->setField('name', '');

            return $product_image;
        }
    }

    /**
     * @return bool
     */
    public function news()
    {
        return false;
    }

    /**
     * Возвращает старую цену (Если есть признак спец. цены)
     * @return int
     */
    public function old_price()
    {
        $old_price = $this->option()->old_price;

        return $old_price > $this->price() && $this->option()->special ? (int)$old_price : null;
    }

    /**
     * Возвращает первую опцию. Необходимо для получения цены, старой цены и метки спец. цена
     * @return \Parishop\ORMWrappers\Option\Entity
     */
    public function option()
    {
        if($this->option === null) {
            $this->option = $this->options()->getByOffset(0);
        }

        return $this->option;
    }

    public function parent_categories()
    {
        $category = $this->builder->components()->orm()->category->relatedTo(
            'product_sub_types', $this->product_sub_type_id
        )->where('sexId', $this->sexId)->findOne();
        if($category) {
            return array_merge($category->parent_categories(), array($category));
        }

        return array();
    }

    public function points()
    {
        $cart     = $this->builder->frameworkBuilder()->cart();
        $product  = (object)array('option' => $this->option(), 'price' => $this->option()->price, 'quantity' => 1);
        $products = $cart->builder()->buildProducts(array($product));

        return $cart->builder()->buildPoints($products);
    }

    /**
     * Возвращает цену первой опции
     * TODO-Linfuby: Если товар акционный, было предложение выводить цену с учетом скидки по акции
     * @return int
     */
    public function price()
    {
        return (int)$this->option()->price;
    }

    /**
     * @return array
     */
    public function related()
    {
        /**
         * @var \PHPixie\Database\Driver\PDO\Query\Type\Select $query
         */
        $query = $this->builder->components()->database()->get()->selectQuery();
        $query->fields('products.id');
        $query->table($this->builder->components()->orm()->repository('product')->config()->get('table'));
        $query->where('sexId', $this->sexId);
        $query->join($this->builder->components()->orm()->repository('shopRest')->config()->get('table'));
        $query->on('products.id', 'shopRests.productId');
        $query->whereNot('products.id', $this->id());
        $query->startAndGroup();
        switch($this->productPartId) {
            case '6001':
                $query->startOrGroup();
                $query->where('productPartId', 6002);
                $query->where('lineId', $this->lineId);
                $query->endGroup();
                $query->startOrGroup();
                $query->where('productPartId', 6002);
                $query->where('mainColorId', $this->mainColorId);
                $query->endGroup();
                break;
            case '6002':
                $query->startOrGroup();
                $query->where('productPartId', 6001);
                $query->where('lineId', $this->lineId);
                $query->endGroup();
                $query->startOrGroup();
                $query->where('productPartId', 6001);
                $query->where('mainColorId', $this->mainColorId);
                $query->endGroup();
                break;
            default:
                $query->startOrGroup();
                $query->where('productPartId', null);
                $query->where('lineId', $this->lineId);
                $query->endGroup();
                $query->startOrGroup();
                $query->where('productPartId', null);
                $query->where('mainColorId', $this->mainColorId);
                $query->endGroup();
                break;
        }
        $query->endGroup();
        $query->groupBy('products.id');

        return $this->builder->components()->orm()->product->in($query->offset(0)->limit(16)->execute()->getField('id'))->find();
    }

    /**
     * @return bool
     * TODO-Linfuby:
     */
    public function sale()
    {
        return false;
    }

    public function tvs()
    {
        return $this->builder->components()->orm()->product->where('tv_id', $this->tv_id)->find(array('mainColor'));
    }

    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        if($resolverPath === null) {
            $resolverPath = 'app.product';
        }

        return parent::url(
            array(
                'processor' => 'products',
                'action'    => 'product',
                'id'        => $this->par,
            ), $query, $resolverPath
        );
    }

    /**
     * @return bool
     */
    public function wishlist()
    {
        if($customer = $this->builder->customer()) {
            $wishlist = $customer->wishlist();

            return $wishlist->get($this->id());
        }

        return false;
    }

}
