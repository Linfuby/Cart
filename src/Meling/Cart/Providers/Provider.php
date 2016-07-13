<?php
namespace Meling\Cart\Providers;

/**
 * Провайдер Покупателя
 * Class Provider
 * @package Meling\Cart\Providers
 */
abstract class Provider
{
    /** @var \PHPixie\ORM */
    protected $orm;

    /** @var mixed */
    protected $cityId;

    /** @var \Meling\Cart\Actions */
    protected $actions;

    /** @var \Meling\Cart\Actions */
    protected $actionsAfter;

    /** @var \Meling\Cart\Addresses */
    protected $addresses;

    /** @var \Meling\Cart\Cards */
    protected $cards;

    /** @var \Meling\Cart\Products */
    protected $products;

    /** @var mixed */
    protected $actionId;

    /**
     * Провайдер Покупателя
     * @param \PHPixie\ORM $orm      Доступ к БД
     * @param mixed        $cityId   Город по умолчанию
     * @param mixed        $actionId Акция по умолчанию
     */
    public function __construct(\PHPixie\ORM $orm, $cityId, $actionId)
    {
        $this->orm      = $orm;
        $this->cityId   = $cityId;
        $this->actionId = $actionId;
    }

    /**
     * Акции доступные Покупателю
     * @return \Meling\Cart\Actions
     */
    public function actions()
    {
        if($this->actions === null) {
            $allowActions = $this->orm->query('allAction');
            $allowActions->where('after', 0);
            $allowActions->whereNot('actionTypeId', 53001);
            if($this->actionsBirthday() === null) {
                $allowActions->whereNot('actionTypeId', 53006);
            }
            if($this->actionsMarriage() === null) {
                $allowActions->whereNot('actionTypeId', 53007);
            }
            $allowActions->startGroup();
            $allowActions->where('date_start', '<=', $this->actionsDate()->format('Y-m-d H:i:s'));
            $allowActions->where('date_end', '>=', $this->actionsDate()->format('Y-m-d H:i:s'));
            $allowActions->orWhere('date_end', '0000-00-00 00:00:00');
            $allowActions->endGroup();
            $actions = array();
            /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $action */
            foreach($allowActions->find() as $action) {
                $actions[(string)$action->id()] = new \Meling\Cart\Actions\Action($action);
            }
            $this->actions = new \Meling\Cart\Actions($actions, $this->action() ? $this->action()->id() : null);
        }

        return $this->actions;
    }

    /**
     * Постпродажные акции доступные Покупателю
     * @return \Meling\Cart\Actions
     */
    public function actionsAfter()
    {
        if($this->actionsAfter === null) {
            $allowActions = $this->orm->query('allowAction');
            $allowActions->where('after', 1);
            $actions = array();
            /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $action */
            foreach($allowActions->find() as $action) {
                $actions[(string)$action->id()] = new \Meling\Cart\Actions\Action($action);
            }
            $this->actionsAfter = new \Meling\Cart\Actions($actions);
        }

        return $this->actionsAfter;
    }

    /**
     * Город по умолчанию (Либо конкретный город)
     * @param mixed $cityId
     * @return \Parishop\ORMWrappers\City\Entity
     */
    public function city($cityId = null)
    {
        if($cityId === null) {
            $cityId = $this->cityId;
        }

        return $this->orm->query('city')->in($cityId)->findOne();
    }

    /**
     * @return Models
     */
    public function models()
    {
        return new Models($this->orm());
    }

    /**
     * @return \PHPixie\ORM
     */
    public function orm()
    {
        return $this->orm;
    }

    /**
     * Товары Покупателя (Корзина)
     * @return \Meling\Cart\Products
     */
    public function products()
    {
        if($this->products === null) {
            $this->products = $this->buildProducts();
        }

        return $this->products;
    }

    public function resetCards()
    {
        $this->cards = null;
    }

    /**
     * Акция по умолчанию (Либо конкретная акция)
     * @param mixed $actionId
     * @return mixed
     */
    protected function action($actionId = null)
    {
        if($actionId === null) {
            $actionId = $this->actionId;
        }
        if($actionId) {
            return $this->orm->query('action')->in($actionId)->findOne();
        }

        return null;
    }

    /**
     * Дата рождения для определения добавления акции типа "День рождения"
     * @return \DateTime
     */
    public abstract function actionsBirthday();

    /**
     * Текущая дата на которую выводить действующие акции
     * @return \DateTime
     */
    public abstract function actionsDate();

    /**
     * Дата свадьбы для определения добавления акции типа "День свадьбы"
     * @return \DateTime
     */
    public abstract function actionsMarriage();

    /**
     * Адреса Покупателя
     * @return \Meling\Cart\Addresses
     */
    public abstract function addresses();

    /**
     * Клубные карты Покупателя
     * @return \Meling\Cart\Cards
     */
    public abstract function cards();

    /**
     * Покупатель
     * @return \Parishop\ORMWrappers\Customer\Entity
     */
    public abstract function customer();

    /**
     * E-mail Покупателя
     * @return string
     */
    public abstract function email();

    /**
     * Имя Покупателя
     * @return string
     */
    public abstract function firstname();

    /**
     * Идентификатор Покупателя
     * @return string
     */
    public abstract function id();

    /**
     * Фамилия Покупателя
     * @return string
     */
    public abstract function lastname();

    /**
     * Отчество Покупателя
     * @return string
     */
    public abstract function middlename();

    /**
     * Телефон Покупателя
     * @return string
     */
    public abstract function phone();

    /**
     * Товары Покупателя
     * @return mixed
     */
    protected abstract function buildProducts();

}

