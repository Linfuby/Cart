<?php
namespace Meling\Cart\Products;

class Product
{
    /**
     * @var \Meling\Cart\Objects\Object
     */
    protected $object;

    /**
     * Product constructor.
     * @param \Meling\Cart\Objects\Object $object
     */
    public function __construct(\Meling\Cart\Objects\Object $object)
    {
        $this->object = $object;
    }


    /**
     * @param array $actions
     * @return array
     */
    public function actionProducts(array $actions = array())
    {
        $actionProducts = array();
        foreach($this->object->getEntity()->actionProducts as $actionProduct) {
            if(in_array($actionProduct->actionId, $actions)) {
                $actionProducts[$actionProduct->actionId] = $actionProduct->discount;
            }
        }

        return max($actionProducts);
    }

}
