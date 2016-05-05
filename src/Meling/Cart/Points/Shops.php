<?php
namespace Meling\Cart\Points;

class Shops
{
    /**
     * @var array
     */
    protected $shops;

    /**
     * Shops constructor.
     * @param array $shops
     */
    public function __construct(array $shops)
    {
        $this->shops = $shops;
    }

    /**
     * @return array|void
     */
    public function asArray()
    {
        return $this->shops;
    }

    /**
     * @param $id
     * @return object
     * @throws \Exception
     */
    public function get($id)
    {
        if(array_key_exists($id, $this->shops)) {
            return $this->shops[$id];
        }

        return null;
    }

}
