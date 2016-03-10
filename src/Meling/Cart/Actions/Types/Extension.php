<?php
namespace Meling\Cart\Actions\Types;

/**
 * Class Extension
 * @deprecated
 * @package Meling\Cart\Actions\Types
 */
abstract class Extension
{
    /**
     * @var \Meling\Cart\Builder
     */
    protected $builder;

    /**
     * @var \Parishop\ORMWrappers\Action\Entity[]
     */
    protected $actions;

    /**
     * @var int
     */
    protected $totalAmount;

    /**
     * @var int
     */
    protected $totalAction;

    /**
     * @var int
     */
    protected $totalCard;

    /**
     * @var int
     */
    protected $totalDiscount;

    /**
     * @var int
     */
    protected $totalBonuses;

    /**
     * Extension constructor.
     * @param \Meling\Cart\Builder                  $builder
     * @param \Parishop\ORMWrappers\Action\Entity[] $actions
     */
    public function __construct($builder, $actions)
    {
        $this->builder = $builder;
        $this->actions = $actions;
    }

    public function totalAction()
    {
        if($this->totalAction === null) {
            $this->totalDiscount();
        }

        return $this->totalAction;
    }

    public function totalAmount()
    {
        if($this->totalAmount === null) {
            foreach($this->builder->products()->asArray() as $product) {
                $this->totalAmount += $product->priceTotal();
            }
        }

        return $this->totalAmount;
    }

    /**
     * @return int
     */
    public function totalBonuses()
    {
        if($this->totalBonuses === null) {
            $this->totalDiscount();
        }

        return $this->totalBonuses;
    }

    public function totalCard()
    {
        if($this->totalCard === null) {
            $this->totalDiscount();
        }

        return $this->totalCard;
    }

    /**
     * @return int
     */
    public function totalDiscount()
    {
        return $this->totalDiscount;
    }

    public function updateBonuses($totalBonuses)
    {
        // Добавляем Накопленные баллы
        $this->totalBonuses = (int)$totalBonuses;
    }

    /**
     * @param \Meling\Cart\Products\Product $product
     * @param int                           $price
     * @param int                           $discountProductAction
     * @param int                           $discountProductCard
     * @param int                           $totalBonuses
     */
    protected function updateTotal(
        $product,
        $price,
        $discountProductAction = 0,
        $discountProductCard = 0,
        $totalBonuses = 0)
    {
        // Скидка должна быть в диапазоне от 0% до 100%
        $discountProductAction = $discountProductAction < 0 ? 0 : $discountProductAction;
        $discountProductAction = $discountProductAction > 100 ? 100 : $discountProductAction;
        // Скидка должна быть в диапазоне от 0% до 100%
        $discountProductCard = $discountProductCard < 0 ? 0 : $discountProductCard;
        $discountProductCard = $discountProductCard > 100 ? 100 : $discountProductCard;
        // Получаем Максимальную скидку на товар
        $discountProduct = $discountProductAction + $discountProductCard;
        // Скидка должна быть в диапазоне от 0% до 100%
        $discountProduct = $discountProduct < 0 ? 0 : $discountProduct;
        $discountProduct = $discountProduct > 100 ? 100 : $discountProduct;
        // Размер скидки по Акции
        $priceAction = round($price / 100 * $discountProductAction, 0, PHP_ROUND_HALF_DOWN);
        // Размер скидки по Карте
        $priceCard = round($price / 100 * $discountProductCard, 0, PHP_ROUND_HALF_DOWN);
        // Размер скидки на Товар
        $priceProduct = $price / 100 * (100 - $discountProduct);
        // Добавляем размер скидки по Акции
        $this->totalAction += (int)$priceAction;
        // Добавляем размер скидки по Карте
        $this->totalCard += (int)$priceCard;
        // Добавляем размер скидки на Товары
        $this->totalDiscount += (int)$priceProduct;
        // Добавляем Накопленные баллы
        $this->totalBonuses += (int)$totalBonuses;
        // Обновляем финальную стоимость Товара
        $product->priceFinal((int)$priceProduct);
    }

}
