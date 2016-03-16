<?php
namespace Meling\Cart\Providers;

abstract class Provider
{
    /**
     * @var \Meling\Cart\Source
     */
    protected $source;

    /**
     * Provider constructor.
     * @param \Meling\Cart\Source $source
     */
    public function __construct($source)
    {
        $this->source = $source;
    }

    public function action()
    {
        if($actionId = $this->source->session()->get('actionId')) {
            return $this->source()->query('action')->in($actionId)->findOne();
        }

        return null;
    }

    public function actions()
    {
        return $this->source()->getActions(true, $this->dateActual());
    }

    public function actionsAfter()
    {
        return $this->source()->getActions(false, $this->dateActual(), $this->dateBirthday(), $this->dateMarriage());
    }

    /**
     * @return \Meling\Cart\Source
     */
    public function source()
    {
        return $this->source;
    }

    /**
     * @param \Meling\Cart\Orders\Order\Certificates\Certificate $certificate
     * @return int
     */
    public abstract function addCertificate($certificate);

    /**
     * @param \Meling\Cart\Orders\Order\Products\Product $product
     * @return int
     */
    public abstract function addProduct($product);

    /**
     * @return array
     */
    public abstract function cards();

    /**
     * @return array
     */
    public abstract function certificates();

    public abstract function clearCertificates();

    public abstract function clearProducts();

    /**
     * @return \DateTime
     */
    public abstract function dateActual();

    /**
     * @return \DateTime
     */
    public abstract function dateBirthday();

    /**
     * @return \DateTime
     */
    public abstract function dateMarriage();

    public abstract function id();

    /**
     * @return array
     */
    public abstract function products();

    public abstract function removeCertificates($id);

    public abstract function removeProducts($id);
}
