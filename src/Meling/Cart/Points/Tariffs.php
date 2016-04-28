<?php
namespace Meling\Cart\Points;

class Tariffs
{
    /**
     * @var \Meling\Cart\Products\Product[]
     */
    protected $products;

    private   $tariffs;

    private   $deliveries;

    /**
     * Tariffs constructor.
     * @param $products
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    public function asArray()
    {
        $this->requireTariffs();

        return $this->tariffs;
    }

    public function deliveries()
    {
        if($this->deliveries === null) {
            $this->deliveries = $this->buildDeliveries();
        }

        return $this->deliveries;
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
                    $tariffs[$shopTariff->id()] = $shopTariff->asObject();
                }
            }
        }
        $this->tariffs = $tariffs;
    }

}
