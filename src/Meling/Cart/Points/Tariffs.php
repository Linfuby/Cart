<?php
namespace Meling\Cart\Points;

class Tariffs
{
    /**
     * @var \Meling\Cart\Products\Product[]
     */
    protected $products;

    /**
     * @var \Meling\Tests\ORMWrappers\Entities\ShopTariff[]
     */
    private $tariffs;

    /**
     * @var \Meling\Cart\Points\Tariffs\Deliveries\Delivery[]
     */
    private $deliveries;

    /**
     * Tariffs constructor.
     * @param \Meling\Cart\Products\Product[] $products
     */
    public function __construct(array $products)
    {
        $this->products = $products;
    }

    /**
     * @return \Meling\Tests\ORMWrappers\Entities\ShopTariff[]
     */
    public function asArray()
    {
        $this->requireTariffs();

        return $this->tariffs;
    }

    public function deliveries()
    {
        if($this->deliveries === null) {
            $this->requireTariffs();
            $this->deliveries = $this->buildDeliveries();
        }

        return $this->deliveries;
    }

    /**
     * @param $id
     * @return \Meling\Tests\ORMWrappers\Entities\ShopTariff
     * @throws \Exception
     */
    public function get($id)
    {
        $this->requireTariffs();
        if(array_key_exists($id, $this->tariffs)) {
            return $this->tariffs[$id];
        }
        throw new \Exception('Tariff ' . $id . ' does not exist');
    }

    protected function buildDeliveries()
    {
        return new Tariffs\Deliveries($this);
    }

    protected function requireTariffs()
    {
        if($this->tariffs !== null) {
            return;
        }
        $tariffs = array();
        foreach($this->products as $product) {
            foreach($product->entity()->shops() as $shop) {
                foreach($shop->shopTariffs() as $shopTariff) {
                    $tariffs[$shopTariff->id()] = $shopTariff;
                }
            }
        }
        $this->tariffs = $tariffs;
    }

}
