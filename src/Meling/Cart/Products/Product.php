<?php
namespace Meling\Cart\Products;

/**
 * Class Product
 * 1. Название
 * 2. Опция/Сертификат (Интерфейс Товара)
 * 3. Цена
 * 4. Количество
 * 5. Точка Отправки
 * 6. Точка Получения
 * 7. Адрес Получателя
 * 8. Способ доставки
 * 9. Акции
 * 10. Доступные Точки Получения
 * 11. Доступные Тарифы отправления (Необходимо указание города Получения)
 * @package Meling\Cart\Products
 */
class Product
{
    /**
     * @var \Meling\Cart\Providers\Product
     */
    protected $product;

    protected $priceFinal;

    /**
     * @param \Meling\Cart\Providers\Product $product
     */
    public function __construct($product)
    {
        $this->product    = $product;
        $this->priceFinal = $this->priceTotal();
    }

    /**
     * @return \Meling\Tests\ORMWrappers\Entities\Option|\Meling\Tests\ORMWrappers\Entities\Certificate
     */
    public function entity()
    {
        return $this->product->entity;
    }

    public function priceFinal($price = null)
    {
        if((int)$price) {
            $this->priceFinal = $this->priceFinal - (int)$price;
        }

        return $this->priceFinal;
    }

    public function priceTotal()
    {
        return $this->product->price * $this->product->quantity;
    }

}
