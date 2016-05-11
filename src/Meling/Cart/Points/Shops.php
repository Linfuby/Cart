<?php
namespace Meling\Cart\Points;

class Shops
{
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity[]
     */
    protected $shops;

    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity[]
     */
    protected $rests;

    /**
     * @var Point[]
     */
    protected $points;

    /**
     * Shops constructor.
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity[] $shops
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity[] $rests
     */
    public function __construct(array $shops, array $rests)
    {
        $this->shops = $shops;
    }

    public function asArray()
    {
        $this->requirePoints();

        return $this->points;
    }

    public function get($id)
    {
        $this->requirePoints();
        if(array_key_exists($id, $this->points)) {
            return $this->points[$id];
        }
        throw new \Exception('Shop ' . $id . ' does not exist');
    }

    protected function buildPoint($shop, $rests)
    {
        return new \Meling\Cart\Points\Point\Shop($shop, $rests);
    }

    protected function requirePoints()
    {
        if($this->points !== null) {
            return;
        }
        $points = array();
        foreach($this->shops as $shop) {
            $points[(string)$shop->id()] = $this->buildPoint($shop, empty($this->rests[(string)$shop->id()]) ? array() : $this->rests[(string)$shop->id()]);
        }
        $this->points = $points;
    }

}
