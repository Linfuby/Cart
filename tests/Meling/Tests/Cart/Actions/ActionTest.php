<?php
namespace Meling\Tests\Cart\Actions;

/**
 * Тестирование акции.
 * Используется два режима акций:
 * а) Идентификатор: 1, Название: "Скидка на всё", Использовать клубную карту: Нет, Только спец. цены: Да, Скидка: 25%
 * б) Акция отсутствует
 * Class ActionTest
 * @package Meling\Tests\Cart\Actions
 */
class ActionTest extends \PHPixie\Test\Testcase
{
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    protected $entity;

    public function setUp()
    {
        // Сущность акции
        $this->entity = $this->abstractMock('\PHPixie\ORM\Models\Type\Database\Entity');
    }

    /**
     * 1. Получение идентификатора текущей акции (При наличии выбраной акции) - Результат: 1
     */
    public function test1()
    {
        $this->method($this->entity, 'id', 1);
        // Класс Акции
        $action = new \Meling\Cart\Actions\Action(new \PHPixie\ORM\Wrappers\Type\Database\Entity($this->entity));
        // Идентификатор
        $this->assertEquals(1, $action->id());
    }

    /**
     * 2. Получение идентификатора текущей акции (Без акций) - Результат: null
     */
    public function test2()
    {
        // Класс Акции (Параметр оставляем пустым, так как нет выбранной акции)
        $action = new \Meling\Cart\Actions\Action();
        // Идентификатор
        $this->assertNull($action->id());
    }

    /**
     * 3. Получение названия текущей акции (При наличии выбраной акции) - Результат: "Скидка на всё"
     */
    public function test3()
    {
        $this->method($this->entity, 'getField', 'Скидка на всё', array('name'));
        // Класс Акции
        $action = new \Meling\Cart\Actions\Action(new \PHPixie\ORM\Wrappers\Type\Database\Entity($this->entity));
        // Идентификатор
        $this->assertEquals('Скидка на всё', $action->name());
    }

    /**
     * 4. Получение названия текущей акции (Без акций) - Результат: null
     */
    public function test4()
    {
        // Класс Акции
        $action = new \Meling\Cart\Actions\Action();
        // Идентификатор
        $this->assertNull($action->name());
    }

    /**
     * 5. Получение метки "Использовать клубную карту" для текущей акции (При наличии выбраной акции) - Результат: false
     */
    public function test5()
    {
        $this->method($this->entity, 'getField', '0', array('with_card'));
        // Класс Акции
        $action = new \Meling\Cart\Actions\Action(new \PHPixie\ORM\Wrappers\Type\Database\Entity($this->entity));
        // Идентификатор
        $this->assertFalse($action->useCard());
    }

    /**
     * 6. Получение метки "Использовать клубную карту" для текущей акции (Без акций) - Результат: true
     */
    public function test6()
    {
        // Класс Акции
        $action = new \Meling\Cart\Actions\Action();
        // Идентификатор
        $this->assertTrue($action->useCard());
    }

    /**
     * 7. Получение метки "Только для спец. цен" для текущей акции (При наличии выбраной акции) - Результат: true
     */
    public function test7()
    {
        $this->method($this->entity, 'getField', '1', array('price_flag'));
        // Класс Акции
        $action = new \Meling\Cart\Actions\Action(new \PHPixie\ORM\Wrappers\Type\Database\Entity($this->entity));
        // Идентификатор
        $this->assertTrue($action->useSpecial());
    }

    /**
     * 8. Получение метки "Только для спец. цен" для текущей акции (Без акций) - Результат: false
     */
    public function test8()
    {
        // Класс Акции
        $action = new \Meling\Cart\Actions\Action();
        // Идентификатор
        $this->assertFalse($action->useSpecial());
    }

    /**
     * 9. Расчет скидки по текущей акции (При наличии выбраной акции) - Результат:
     * В корзине будет находится три товара:
     * а) Спец. цена: Да, Стоимость: 2000, Старая цена: 2500, Количество 1, Участвует в акции: "Ассортимент": Скидка: 20%
     * б) Спец. цена: Да, Стоимость: 1000, Старая цена: 1200, Количество 2
     * в) Спец. цена: Нет, Стоимость: 3000, Старая цена: 0, Количество 1, Участвует в акции: "Ассортимент": Скидка: 30%
     * У покупателя есть Клубная карта со скидкой 10% и 500 бонусами
     * Итого, Акция -25% без карты и со спец. ценами
     * а) Есть спец. цена - Скидка 0
     * б) Есть спец. цена - Скидка 0
     * б) Нет спец цены, Есть карта - Скидка 20+10 = 30% от стоимости 3000 Скидка 1000
     */
    public function test9()
    {
        /** @var \PHPixie\ORM $orm */
        $orm      = new \Meling\Tests\ORMStub();
        $provider = new \Meling\Cart\Providers\Provider\Custom($orm, -6081056, 1);
        $products = new \Meling\Cart\Products\Custom($provider);
        $models   = new \Meling\Cart\Providers\Models($orm);

        $product1 = $this->abstractMock('\PHPixie\ORM\Models\Type\Database\Entity');
        $this->method($product1, '__call', array());
        $product1 = new \Parishop\ORMWrappers\Option\Entity($product1, null);
        $product1 = new \Meling\Cart\Products\Product\Option($models->option(), $products, $product1, 1, 1, 2000);
        $products->offsetSet(1, $product1);

        $product2 = $this->abstractMock('\PHPixie\ORM\Models\Type\Database\Entity');
        $this->method($product2, '__call', array());
        $product2 = new \Parishop\ORMWrappers\Option\Entity($product2, null);
        $product2 = new \Meling\Cart\Products\Product\Option($models->option(), $products, $product2, 2, 2, 1000);
        $products->offsetSet(2, $product2);

        $product3 = $this->abstractMock('\PHPixie\ORM\Models\Type\Database\Entity');
        $this->method($product3, '__call', array());
        $product3 = new \Parishop\ORMWrappers\Option\Entity($product3, null);
        $product3 = new \Meling\Cart\Products\Product\Option($models->option(), $products, $product3, 3, 1, 3000);
        $products->offsetSet(3, $product3);

        $action = $orm->query('action')->where('actionTypeId', 53006)->findOne();
        // Класс Акции
        $action = new \Meling\Cart\Actions\Action($action);
        $card   = new \Meling\Cart\Cards\Card(1, '10%', 10, 500);
        // Идентификатор
        $this->assertEquals(1400, $action->calculate($card, $products));
    }

    /**
     * 10. Расчет скидки по текущей акции (Без акций) - Результат:
     */
    public function testA()
    {
        // Класс Акции
        $action = new \Meling\Cart\Actions\Action();
        // Идентификатор
        //$this->assertTrue($action->calculate());
    }

}


