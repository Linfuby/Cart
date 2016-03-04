<?php
namespace Meling\Cart\Providers;

interface Objects
{
    /**
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $product
     * @param array                                      $data
     * @return int
     */
    public function add($product, $data = array());

    /**
     * @return $this
     */
    public function clear();

    /**
     * @return \Meling\Cart\Products\Product[]
     */
    public function objects();

    /**
     * @param int $id
     * @return $this
     */
    public function remove($id);

}
