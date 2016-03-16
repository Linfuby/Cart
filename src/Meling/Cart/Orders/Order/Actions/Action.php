<?php
namespace Meling\Cart\Orders\Order\Actions;

/**
 * Выбранная Покупателем Акция
 * Class Action
 * @method string id()
 * @property bool with_card
 * @package Meling\Cart\Orders\Order\Actions
 */
class Action
{
    /**
     * @var null|\PHPixie\ORM\Models\Type\Database\Entity
     */
    protected $action;

    /**
     * @var \Meling\Cart\Orders\Order\Products
     */
    protected $products;

    /**
     * @var Types\Type
     */
    protected $type;

    /**
     * @var Cards\Card
     */
    protected $card;

    /**
     * Action constructor.
     * @param \Meling\Cart\Orders\Order\Products       $products
     * @param \PHPixie\ORM\Models\Type\Database\Entity $action
     * @param Cards\Card                               $card
     */
    public function __construct($products, $action = null, $card = null)
    {
        $this->products = $products;
        $this->action   = $action;
        $this->card     = $card;
    }

    function __call($name, $arguments)
    {
        return $this->action ? $this->action->{$name}($arguments) : null;
    }


    public function __get($name)
    {
        return $this->action ? $this->action->{$name} : null;
    }

    public function name()
    {
        return $this->type()->name();
    }

    public function totalDiscount()
    {
        return $this->type()->total();
    }

    public function type()
    {
        if($this->type === null) {
            if($this->action) {
                $class = '\Meling\Cart\Orders\Order\Actions\Types\Type' . $this->action->actionTypeId;
                if(class_exists($class)) {
                    $this->type = new $class($this->products, $this->action, $this->card);
                } else {
                    $this->type = new \Meling\Cart\Orders\Order\Actions\Types\Type53000(
                        $this->products, $this->action, $this->card
                    );
                }
            } else {
                $this->type = new \Meling\Cart\Orders\Order\Actions\Types\Type53000(
                    $this->products, $this->action, $this->card
                );
            }
        }

        return $this->type;
    }

}
