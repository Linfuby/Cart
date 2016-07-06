<?php
namespace Meling\Cart\Points;

/**
 * Точка Отправления Товара
 * Interface Point
 * @package Meling\Cart\Points
 */
abstract class Point
{
    /** @var mixed */
    protected $id;

    /**
     * Point constructor.
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }

    public abstract function cost();

    public abstract function name();

    public abstract function nameCity();

    public abstract function nameFull();
}

