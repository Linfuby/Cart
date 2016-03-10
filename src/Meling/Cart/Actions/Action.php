<?php
namespace Meling\Cart\Actions;

/**
 * Выбранная Покупателем Акция
 * Class Action
 * @package Meling\Cart\Actions
 */
class Action
{
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $action;

    /**
     * @var \Meling\Cart\Totals
     */
    protected $totals;

    /**
     * @var Types\Type
     */
    protected $type;

    /**
     * Action constructor.
     * @param \Meling\Cart\Totals                        $totals
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $action
     */
    public function __construct($totals, $action = null)
    {
        $this->totals = $totals;
        $this->action = $action;
    }

    public function type()
    {
        if($this->type === null) {
            if($this->action) {
                $class = '\Meling\Cart\Actions\Types\Type' . $this->action->getField('actionTypeId');
                if(class_exists($class)) {
                    $this->type = new $class($this->totals, $this->action);
                } else {
                    $this->type = new \Meling\Cart\Actions\Types\Type53000($this->totals, $this->action);
                }
            } else {
                $this->type = new \Meling\Cart\Actions\Types\Type53000($this->totals, $this->action);
            }
        }

        return $this->type;
    }

}
