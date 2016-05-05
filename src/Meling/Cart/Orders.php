<?php
namespace Meling\Cart;

class Orders
{
    /**
     * @var Products
     */
    protected $products;

    /**
     * @var Points\Point[]
     */
    protected $points;

    /**
     * @var Orders\Order[]
     */
    protected $orders;

    private   $action;

    private   $card;

    /**
     * Points constructor.
     * @param Products\Product[]                  $products
     * @param Points                              $points
     * @param \Meling\Cart\Actions                $actions
     * @param \Parishop\ORMWrappers\Action\Entity $action
     * @param \Meling\Cart\Cards\Card             $card
     */
    public function __construct(array $products, Points $points, $actions, $action, $card)
    {
        $this->products = $products;
        $this->points   = $points;
        $this->actions  = $actions;
        $this->action   = $action;
        $this->card     = $card;
    }

    public function asArray()
    {
        $this->requireOrders();

        return $this->orders;
    }

    public function count()
    {
        $this->requireOrders();

        return count($this->orders);
    }

    public function get($id)
    {
        $this->requireOrders();
        if(array_key_exists($id, $this->orders)) {
            return $this->orders[$id];
        }
        throw new \Exception('Order ' . $id . ' does not exist');
    }

    /**
     * @param int $id
     * @param     $name
     * @param     $products
     * @return Orders\Order
     */
    protected function buildOrder($id, $name, $products)
    {
        return new Orders\Order($id, $name, $products, $this->buildTotals($products));
    }

    protected function buildTotals($products)
    {
        return new \Meling\Cart\Totals($products, $this->points, $this->actions, $this->action, $this->card);
    }

    protected function requireOrders()
    {
        if($this->orders !== null) {
            return;
        }
        $orders = array();
        $points = array();
        foreach($this->products as $productId => $product) {
            try {
                if($point = $this->points->getFor($productId)->point()) {
                    $points[$product->pvz][$productId] = $product;
                }
            } catch(\Exception $e) {
                $product->shopId       = null;
                $product->deliveryId   = null;
                $product->shopTariffId = null;
                $product->addressId    = null;
                $product->pvz          = null;
            }

        }
        foreach($points as $name => $products) {
            $orders[] = $this->buildOrder(count($orders), $name, $products);
        }
        $this->orders = $orders;
    }
}
