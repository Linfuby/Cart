<?php
namespace Meling\Cart\Providers;

class Order extends Provider
{
    /**
     * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    protected $order;

    /**
     * Order constructor.
     * @param \Meling\Cart\Source                    $source
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $order
     */
    public function __construct($source, $order)
    {
        $this->order = $order;
        parent::__construct($source);
    }

    function __call($name, $arguments)
    {
        return $this->order->{$name}($arguments);
    }

    public function __get($name)
    {
        return $this->order->{$name};
    }

    /**
     * @return array
     */
    public function cards()
    {
        return $this->order->customer()->customerCards()->asArray();
    }

    /**
     * @return array
     */
    public function certificates()
    {
        return $this->order->orderCertificates()->asArray();
    }

    /**
     * @return \DateTime
     */
    public function dateActual()
    {
        return new \DateTime($this->order->created);
    }

    /**
     * @return \DateTime
     */
    public function dateBirthday()
    {
        $birthday = $this->order->customer()->getField('birthday');
        if($birthday && $birthday != '0000-00-00') {
            $birthday_use = $this->order->customer()->getField('birthday_use');
            if($birthday_use && $birthday_use != '0000-00-00') {
                if(date('Y') == date_create_from_format('Y-m-d', $birthday_use)->format('Y')) {
                    return null;
                }
            }

            return new \DateTime($birthday);
        }

        return null;
    }

    /**
     * @return \DateTime
     */
    public function dateMarriage()
    {
        $marriage = $this->order->customer()->getField('marriage');
        if($marriage && $marriage != '0000-00-00') {
            $marriage_use = $this->order->customer()->getField('marriage_use');
            if($marriage_use && $marriage_use != '0000-00-00') {
                if(date('Y') == date_create_from_format('Y-m-d', $marriage_use)->format('Y')) {
                    return null;
                }
            }

            return new \DateTime($marriage);
        }

        return null;
    }

    public function id()
    {
        return $this->order->id();
    }

    /**
     * @return array
     */
    public function products()
    {
        return $this->order->orderProducts()->asArray();
    }

}