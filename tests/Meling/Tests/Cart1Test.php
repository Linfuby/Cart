<?php
namespace Meling\Tests;

/**
 * Class CartTest
 * @package Meling\Tests
 */
class Cart1Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart
     */
    protected $cart;

    public static function product1()
    {
        return (object)array(
            'id'           => 1,
            'customerId'   => 13,
            'optionId'     => -1,
            'shopId'       => null,
            'shopTariffId' => 1,
            'shopTariff'   => (object)array(
                'id'         => 1,
                'name'       => 'В пределах МКАД',
                'deliveryId' => 1,
                'delivery'   => (object)array(
                    'id'    => '1',
                    'name'  => 'Курьер',
                    'alias' => 'courier',
                ),
                'payments'   => array(
                    (object)array(
                        'id'   => 1,
                        'name' => 'Наличные',
                    ),
                ),
            ),
            'addressId'    => 6215,
            'pvz'          => 'Адрес ПВЗ',
            'price'        => 999,
            'old_price'    => 1200,
            'special'      => 1,
            'quantity'     => 3,
        );
    }

    public static function product2()
    {
        return (object)array(
            'id'           => 2,
            'customerId'   => 13,
            'optionId'     => -2,
            'shopId'       => -1565,
            'shopTariffId' => null,
            'addressId'    => null,
            'pvz'          => 'Адрес ПВЗ',
            'price'        => 1001,
            'old_price'    => 1600,
            'special'      => 0,
            'quantity'     => 1,
        );
    }

    public function setUp()
    {
        $slice      = new \PHPixie\Slice();
        $provider   = new \Meling\CartProviders\Customer(
            $slice->editableArrayData(), new \Meling\Tests\CartProviders\Customer()
        );
        $slice      = new \PHPixie\Slice();
        $session    = $slice->editableArrayData();
        $this->cart = new \Meling\Cart($provider, $session);
    }

    public function testAttributesBuilder()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Builder', 'builder', $this->cart);
    }

    public function testAttributesBuilderDeliveries()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Builder', 'builder', $this->cart->deliveries());
    }

    public function testAttributesBuilderProducts()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Builder', 'builder', $this->cart->products());
    }

    public function testAttributesBuilderTotals()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Builder', 'builder', $this->cart->totals());
    }

    public function testMethodProducts()
    {
        $this->assertInstanceOf('\Meling\Cart\Products', $this->cart->products());
    }

    public function testMethodProductsAdd()
    {
        $this->cart->products()->add($this->product1());
        $this->cart->products()->add($this->product2());
        $this->cart->products()->clear();
        $this->assertEquals(array(), $this->cart->products()->asArray());
    }

    public function testMethodProductsAsArray()
    {
        $this->assertEquals(array(), $this->cart->products()->asArray());
    }

    public function testMethodProductsCount()
    {
        $this->cart->products()->add($this->product1());
        $this->cart->products()->add($this->product2());
        $this->assertEquals(2, $this->cart->products()->count());
    }

    public function testMethodProductsGet()
    {
        $this->cart->products()->add($this->product1());
        foreach($this->cart->products()->asArray() as $key => $product) {
            $this->assertEquals($product, $this->cart->products()->get($key));
        }
    }

    public function testMethodProductsProductPrice()
    {
        $this->cart->products()->add($this->product1());
        foreach($this->cart->products()->asArray() as $product) {
            $this->assertEquals(999, $product->price());
        }
    }

    public function testMethodProductsProductPriceFinal()
    {
        $this->cart->products()->add($this->product1());
        foreach($this->cart->products()->asArray() as $product) {
            $this->assertEquals(999, $product->priceFinal());
        }
    }

    public function testMethodProductsProductPriceTotal()
    {
        $this->cart->products()->add($this->product1());
        foreach($this->cart->products()->asArray() as $product) {
            $this->assertEquals(2997, $product->priceTotal());
        }
    }

    public function testMethodProductsProductPriceTotalFinal()
    {
        $this->cart->products()->add($this->product1());
        foreach($this->cart->products()->asArray() as $product) {
            $this->assertEquals(2997, $product->priceTotalFinal());
        }
    }

    public function testMethodProductsProductPriceTotalOld()
    {
        $this->cart->products()->add($this->product1());
        foreach($this->cart->products()->asArray() as $product) {
            $this->assertEquals(3600, $product->priceTotalOld());
        }
    }

    public function testMethodProductsQuantity()
    {
        $this->cart->products()->add($this->product1());
        $this->cart->products()->add($this->product2());
        $this->assertEquals(4, $this->cart->products()->quantity());
    }

    public function testMethodProductsRemove()
    {
        $this->cart->products()->add($this->product1());
        $this->cart->products()->remove(1);
        $this->assertEquals(array(), $this->cart->products()->asArray());
    }

    /**
     * @expectedException \Exception
     */
    public function testMethodProductsThrow()
    {
        $this->cart->products()->get('get');
    }

    public function testMethodTotalsActionsName()
    {
        $this->assertEquals('Скидка по Акции:', $this->cart->totals()->actions()->name());
    }

    public function testMethodTotalsActionsTotal()
    {
        // TODO-Linfuby: Добавить Товары с Акциями
        $this->assertEquals(0, $this->cart->totals()->actions()->total());
    }

    public function testMethodTotalsAmountName()
    {
        $this->assertEquals('Сумма:', $this->cart->totals()->amount()->name());
    }

    public function testMethodTotalsAmountTotal()
    {
        $this->cart->products()->add($this->product1());
        $this->assertEquals(2997, $this->cart->totals()->amount()->total());
    }

    public function testMethodTotalsBonusesName()
    {
        $this->assertEquals('Начислено бонусов:', $this->cart->totals()->bonuses()->name());
    }

    public function testMethodTotalsBonusesTotal()
    {
        // TODO-Linfuby: Добавить Товары с Бонусами
        $this->assertEquals(0, $this->cart->totals()->bonuses()->total());
    }

    public function testMethodTotalsCardName()
    {
        $this->assertEquals('Скидка по Клубной карте:', $this->cart->totals()->card()->name());
    }

    public function testMethodTotalsCardTotal()
    {
        // TODO-Linfuby: Добавить Товары с Картой
        $this->assertEquals(0, $this->cart->totals()->card()->total());
    }

    public function testMethodTotalsShippingName()
    {
        $this->assertEquals('Доставка:', $this->cart->totals()->shipping()->name());
    }

    public function testMethodTotalsShippingTotal()
    {
        // TODO-Linfuby: Добавить стоимость доставки
        $this->assertEquals(0, $this->cart->totals()->shipping()->total());
    }

    public function testMethodTotalsTotalName()
    {
        $this->assertEquals('Итого:', $this->cart->totals()->total()->name());
    }

    public function testMethodTotalsTotalTotal()
    {
        $this->cart->products()->add($this->product1());
        // TODO-Linfuby: Добавить Товары с Картой, Акций и Доставку
        $this->assertEquals(2997, $this->cart->totals()->total()->total());
    }

}
