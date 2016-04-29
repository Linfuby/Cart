<?php
namespace Meling\Cart\Providers;

/**
 * Провайдер авторизованного Покупателя
 * Class User
 * @package Meling\Cart\Providers
 */
class User extends \Meling\Cart\Providers\Provider
{
    /**
     * @var \Meling\Tests\ORMWrappers\Entities\Customer
     */
    private $user;

    /**
     * Provider constructor.
     * @param \PHPixie\ORM                          $orm
     * @param \PHPixie\HTTP\Context\Session         $session
     * @param \Parishop\ORMWrappers\City\Entity     $city
     * @param \Parishop\ORMWrappers\Customer\Entity $user
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context\Session $session, \Parishop\ORMWrappers\City\Entity $city, \Parishop\ORMWrappers\Customer\Entity $user)
    {
        $this->user = $user;
        // Если У Покупателя есть адреса - Необходимо переопределить Город по умолчанию
        if($this->user->addresses()) {
            // Если у Покупателя нет Адреса установленного по умолчанию
            if(!($address = $this->user->address())) {
                // Делаем первый доступный Адрес по умолчанию
                $address = $this->user->addresses()->getByOffset(0);
            }
            // Переопределяем Город по умолчанию из Адреса по умолчанию
            $city = $address->city();
        }
        parent::__construct($orm, $session, $city);
    }

    /**
     * Формируем список сертификатов в виде Товаров для корзины
     * @return array|Product[]
     */
    public function certificates()
    {
        if($this->certificates === null) {
            $this->certificates = array();
            foreach($this->user->cartCertificates() as $certificate) {
                $this->certificates[$certificate->id()] = new Product($certificate->id(), $certificate->certificate(), $certificate->getRequiredField('quantity'), $certificate->getRequiredField('price'), $certificate->getRequiredField('shopId'), $certificate->getRequiredField('shopTariffId'), $certificate->getRequiredField('addressId'));
            }
        }

        return $this->certificates;
    }

    /**
     * Формируем Объект Покупателя с необходимыми данными
     * @return Customer
     */
    public function customer()
    {
        if($this->customer === null) {
            /**
             * 1. Идентификатор
             * 2. Фаимилия
             * 3. Имя
             * 4. Отчество
             * 5. E-mail
             * 6. Телефон
             * 7. Дата Рождения
             * 8. Дата последнего использования Акции "День рождения"
             * 9. Дата Свальбы
             * 10. Дата последнего использования Акции "День свадьбы"
             * 11. Адреса
             * 12. Адрес по умолчанию (Чтобы не тянуть Адрес дополнительным запросом, передаем только Идентификатор)
             * 13. Клубная карта Покупателя (Берется из класса Клубных карт. С максимальной скидкой/бонусами из всех доступных Клубных карт Покупателя)
             * 14. Бонусы доступные вне Клубной карты (Берутся со старого ИМ)
             */
            $this->customer = new Customer($this->user->id(), $this->user->getRequiredField('lastname'), $this->user->getRequiredField('firstname'), $this->user->getRequiredField('middlename'), $this->user->getRequiredField('email'), $this->user->getRequiredField('phone'), $this->user->getRequiredField('birthday'), $this->user->getRequiredField('marriage'));
        }

        return $this->customer;
    }

    public function options()
    {
        if($this->options === null) {
            $this->options = array();
            foreach($this->user->cartOptions() as $option) {
                $this->options[$option->id()] = new Product($option->id(), $option->option(), $option->getRequiredField('quantity'), $option->getRequiredField('price'), $option->getRequiredField('shopId'), $option->getRequiredField('shopTariffId'), $option->getRequiredField('addressId'));
            }
        }

        return $this->options;
    }

}
