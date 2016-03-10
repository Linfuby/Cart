<?php
namespace Meling\Cart;

/**
 * Class Products
 * @package Meling\Cart
 */
class Products
{
    /**
     * @var \Meling\Cart\Providers\Subject
     */
    protected $subject;

    /**
     * @var Providers\Objects
     */
    protected $objects;

    /**
     * @var Products\Product[]
     */
    protected $products;

    /**
     * Products constructor.
     * @param Providers\Subject $subject
     * @param Providers\Objects $objects
     */
    public function __construct(Providers\Subject $subject, Providers\Objects $objects)
    {
        $this->subject = $subject;
        $this->objects = $objects;
    }

    /**
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $product
     * @param array                                      $data
     * @return int
     */
    public function add($product, $data = array())
    {
        $this->products = null;

        return $this->objects->add($data);
    }

    public function asArray()
    {
        $this->requireProducts();

        return $this->products;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->products = null;

        return $this->objects->clear();
    }

    public function get($id)
    {
        $this->requireProducts();
        if(array_key_exists($id, $this->products)) {
            return $this->products[$id];
        }
        throw new \Exception('Product ' . $id . ' does not exist');
    }

    /**
     * @param int $id
     * @return $this
     */
    public function remove($id)
    {
        $this->products = null;

        return $this->objects->remove($id);
    }

    protected function requireProducts()
    {
        if($this->products !== null) {
            return;
        }
        $products = array();
        foreach($this->objects->objects() as $key => $object) {
            // TODO
            $products[] = new Products\Product($key, $object);
        }
        $this->products = $products;
    }

}
