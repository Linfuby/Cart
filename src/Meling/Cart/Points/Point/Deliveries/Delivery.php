<?php
namespace Meling\Cart\Points\Point\Deliveries;

/**
 * Class Delivery
 * @package Meling\Cart\Deliveries
 */
class Delivery
{
    /**
     * @var \Parishop\ORMWrappers\City\Entity
     */
    protected $cityEntity;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Delivery\Tariffs
     */
    protected $tariffs;

    protected $id;

    protected $alias;

    /**
     * Delivery constructor.
     * @param mixed                             $id
     * @param string                            $name       Название
     * @param string                            $alias      Псевдоним
     * @param \Parishop\ORMWrappers\City\Entity $cityEntity Город Получателя
     */
    public function __construct($id, $name, $alias, $cityEntity)
    {
        $this->id         = $id;
        $this->name       = $name;
        $this->alias      = $alias;
        $this->cityEntity = $cityEntity;
        $this->tariffs    = $this->buildTariffs();
    }

    public function alias()
    {
        return $this->alias;
    }

    public function cost()
    {
        return $this->tariffs->get() ? $this->tariffs->get()->cost() : 0;
    }

    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name . ' (' . $this->tariffs()->get()->name() . ')';
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function tariffs()
    {
        return $this->tariffs;
    }

    private function buildTariffs()
    {
        return new Delivery\Tariffs($this->cityEntity);
    }

}
