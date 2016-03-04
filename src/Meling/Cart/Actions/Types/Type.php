<?php
namespace Meling\Cart\Actions\Types;

/**
 * Интерфейс Типа акции
 * Interface Type
 * @package Meling\Cart\Actions\Types
 */
abstract class Type
{
    /**
     * @var \Meling\Cart\Totals
     */
    protected $totals;

    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $action;

    /**
     * @var int
     */
    protected $total;


    /**
     * Type constructor.
     * @param \Meling\Cart\Totals                        $totals
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $action
     */
    public function __construct($totals, $action = null)
    {
        $this->totals = $totals;
        $this->action = $action;
    }

}
