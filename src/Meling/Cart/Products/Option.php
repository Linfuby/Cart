<?php
namespace Meling\Cart\Products;

class Option extends Product
{
    /**
     * @var \Meling\Cart\Wrappers\Option\Entity
     */
    protected $entity;

    /**
     * @return \Meling\Cart\Points\Point[]
     */
    public function points()
    {
        if($this->points === null) {
            $this->points = new Points();
            foreach($this->entity->shopRests() as $shopRest) {
                if(!$this->points->get($shopRest->shop()->id())) {
                    $this->points->add($shopRest->shop());
                }
                $this->points->get($shopRest->shop()->id())->add($this->entity->id(), $shopRest->quantity);
            }
        }

        return $this->points;
    }

}
