<?php
namespace Meling\Cart;

class Orders
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var Orders\Order[]
     */
    protected $orders;

    /**
     * @var Orders\Order
     */
    protected $order;

    /**
     * Orders constructor.
     * @param Context $context
     */
    public function __construct($context)
    {
        $this->context = $context;
    }

    /**
     * @return Orders\Order[]
     */
    public function asArray()
    {
        $this->requireOrders();

        return $this->orders;
    }

    /**
     * @param null $id
     * @return Orders\Order
     * @throws \Exception
     */
    public function get($id = null)
    {
        if($id === null) {
            if($this->order === null) {
                $this->order = $this->buildOrder(
                    0, $this->buildProducts($this->context->products()),
                    $this->buildCertificates($this->context->certificates())
                );
            }

            return $this->order;
        }
        $this->requireOrders();
        if(array_key_exists($id, $this->orders)) {
            return $this->orders[$id];
        }

        throw new \Exception('Order ' . $id . ' does not exist');
    }

    protected function buildCertificates(array $certificates = array())
    {
        return new Orders\Order\Certificates($this->context->provider(), $certificates);
    }

    protected function buildOrder($id, Orders\Order\Products $products, Orders\Order\Certificates $certificates)
    {
        return new \Meling\Cart\Orders\Order($id, $products, $certificates);
    }

    protected function buildProducts(array $products = array())
    {
        return new Orders\Order\Products($this->context->provider(), $products);
    }

    protected function requireOrders()
    {
        if($this->orders !== null) {
            return;
        }
        $productsAll     = array();
        $certificatesAll = array();
        foreach($this->context->products() as $product) {
            if($product->shopTariffId) {
                $productsAll[$product->shopTariffId . $product->addressId][] = $product;
            } elseif($product->shopId) {
                $productsAll[$product->shopId][] = $product;
            }
        }
        foreach($this->context->certificates() as $certificate) {
            if($certificate->shopTariffId) {
                $certificatesAll[$certificate->shopTariffId . $certificate->addressId][] = $certificate;
            } elseif($certificate->shopId) {
                $certificatesAll[$certificate->shopId][] = $certificate;
            }
        }
        $orders = array();
        foreach($productsAll as $key => $products) {
            $certificates = array();
            if(!empty($certificatesAll[$key])) {
                $certificates = $certificatesAll[$key];
                unset($certificatesAll[$key]);
            }
            $products     = $this->buildProducts($products);
            $certificates = $this->buildCertificates($certificates);
            $orders[]     = $this->buildOrder(count($orders), $products, $certificates);
        }
        foreach($certificatesAll as $certificates) {
            $products     = $this->buildProducts(array());
            $certificates = $this->buildCertificates($certificates);
            $orders[]     = $this->buildOrder(count($orders), $products, $certificates);
        }
        $this->orders = $orders;
    }

}
