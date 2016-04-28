<?php
namespace Meling\Cart\Points;

/**
 * Точка выдачи товара
 * Идентификатором является Идентификатор Магазина
 * Каждая точка товара имеет свои товары и значет их количество (Добавляются вручную из спис)
 * Каждая точка выдачи имеет свои способы доставки, который "достаются" из общего списка доставок
 * Class Point
 * @package Meling\Cart\Points
 */
class Point
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var \Meling\Cart\Wrappers\Entity
     */
    protected $shop;

    /**
     * @var array
     */
    protected $products  = array();

    protected $instances = array();

    protected $deliveries;

    /**
     * Point constructor.
     * @param mixed                                                   $id
     * @param \PHPixie\ORM\Models\Type\Database\Implementation\Entity $shop
     * @param \Meling\Cart\Deliveries                                 $deliveries
     */
    public function __construct($id, $shop, $deliveries)
    {
        $this->id         = $id;
        $this->shop       = $shop;
        $this->deliveries = $deliveries;
    }

    public function add($productId, $quantity)
    {
        $this->products[$productId] = $quantity;
    }

    public function rests($productId)
    {
        return $this->products[$productId];
    }

}
