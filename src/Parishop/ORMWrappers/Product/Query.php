<?php

namespace Parishop\ORMWrappers\Product;

/**
 * Class Query
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Query\Items $options
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Caching|Entity[] find($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    /**
     * @return $this
     * @deprecated
     */
    public function availability()
    {
        $this->query->relatedTo('options.rests');

        return $this;
    }

    /**
     * TODO-Linfuby: Исключить дублирование запросов
     * @return $this|array|\PHPixie\ORM\Conditions\Builder\Proxy
     */
    public function brands()
    {
        $brands = $this->appBuilder->components()->orm()->brand->relatedTo(
            'products', $this
        );

        return $brands;
    }

    /**
     * TODO-Linfuby: Исключить дублирование запросов
     * @return $this|array|\PHPixie\ORM\Conditions\Builder\Proxy
     */
    public function colors()
    {
        $colors = $this->appBuilder->components()->orm()->option_color->relatedTo(
            'options', $this->options()
        );

        return $colors;
    }

    /**
     * @param $products
     * @return \PHPixie\Database\Driver\PDO\Result
     */
    public function getIds($products)
    {
        /**
         * @var \Parishop\ORMWrappers\Product\Entity $product
         */
        $ids = array();
        foreach($products as $product) {
            $ids[] = $product->id();
        }
        /**
         * @var \PHPixie\Database\Driver\PDO\Query\Type\Select $query
         */
        $query = $this->appBuilder->components()->database()->get()->selectQuery();
        $query->fields('products.id');
        $query->table('products', 'products');
        $query->join('options', 'options');
        $query->on('options.productId', 'products.id');
        $query->join('product_images', 'images');
        $query->on('images.productId', 'products.id');
        $query->join('restOptions', 'rests');
        $query->on('rests.optionId', 'options.id');
        $query->where('products.id', 'in', $ids ? $ids : array(-1));
        $query->groupBy('products.id');

        return $query->execute();
    }

    /**
     * TODO-Linfuby: Исключить дублирование запросов
     * @return string
     */
    public function getPriceMax()
    {
        $option = $this->options()->orderDescendingBy('price')->findOne();

        return $option ? $option->price : 0;
    }

    public function getPriceMin()
    {
        $option = $this->options()->orderAscendingBy('price')->findOne();

        return $option ? $option->price : 0;
    }

    /**
     * @return \PHPixie\Database\Driver\PDO\Result
     */
    public function getSaleIds()
    {
        /**
         * @var \PHPixie\Database\Driver\PDO\Query\Type\Select $query
         */
        $query = $this->appBuilder->components()->database()->get()->selectQuery();
        $query->fields('products.id');
        $query->table('products', 'products');
        $query->join('options', 'options');
        $query->on('options.productId', 'products.id');
        $query->join('product_images', 'images');
        $query->on('images.productId', 'products.id');
        $query->join('restOptions', 'rests');
        $query->on('rests.optionId', 'options.id');
        $query->where('options.old_price', '>', 0);
        $query->where('options.special', 1);
        $query->groupBy('products.id');

        return $query->execute();
    }

    /**
     * TODO-Linfuby: Исключить дублирование запросов
     * @return $this|array|\PHPixie\ORM\Conditions\Builder\Proxy
     */
    public function girths()
    {
        $girths = $this->appBuilder->components()->orm()->option_girth->relatedTo(
            'products', $this
        );

        return $girths;
    }

    /**
     * Сортировка. По умолчанию: По дате изменения По убыванию
     * @param string $ordering
     * @param string $orderDir
     * @return $this
     */
    public function ordering($ordering = 'modified', $orderDir = 'desc')
    {
        return parent::ordering($ordering, $orderDir);
    }

    /**
     * @param $par
     * @return Entity
     * @throws \Exception
     */
    public function par($par)
    {
        if(!$entity = $this->where('par', $par)->findOnePreload()) {
            throw new \Exception('Not Found');
        }

        return $entity;
    }

    public function preload($preload = array())
    {
        return array_merge($preload, array('productImages', 'actions', 'season', 'brand', 'mainColor', 'restOptions', 'optionsRests.size', 'optionsRests.girth'));
    }

    public function rests()
    {
        $this->relatedTo('options');
        $this->relatedTo('productImages');
        $this->relatedTo('restOptions');

        return $this;
    }

    /**
     * TODO-Linfuby: Исключить дублирование запросов
     * @return $this|array|\PHPixie\ORM\Conditions\Builder\Proxy
     */
    public function sizes()
    {
        $sizes = $this->appBuilder->components()->orm()->option_size->relatedTo(
            'products', $this
        );

        return $sizes;
    }

    /**
     * Проверка существования товара по уникальному ID
     * @param string $productId tv_id+mainColorId
     * @return \Parishop\ORMWrappers\Product\Entity
     * @throws \Exception
     */
    public function validate($productId)
    {
        if(empty($productId)) {
            throw new \Exception('Отсутствует productId: ' . $productId);
        }
        if(!isset($this->entities[$productId])) {
            list($tv_id, $mainColorId) = explode('+', $productId);
            if(empty($tv_id)) {
                throw new \Exception('Отсутствует TV_ID: ' . $productId);
            }
            if(empty($mainColorId)) {
                throw new \Exception('Отсутствует mainColorId: ' . $productId);
            }
            $this->where('tv_id', $tv_id);
            $this->where('mainColorId', $mainColorId);
            $entity = $this->findOne(false);
            if(!$entity) {
                throw new \Exception('Не найден товар: ' . $productId);
            }
            $this->entities[$productId] = $entity;
        }

        return $this->entities[$productId];
    }

}
