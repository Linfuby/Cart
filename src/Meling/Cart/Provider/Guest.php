<?php
namespace Meling\Cart\Provider;

class Guest extends \Meling\Cart\Provider
{
    private $guest;

    /**
     * Order constructor.
     * @param \PHPixie\HTTP\Context\Session $guest
     */
    public function __construct($guest)
    {
        $this->guest = $guest;
    }

    /**
     * @return int
     */
    public function rewards()
    {
        return 0;
    }

    protected function requireCertificates()
    {
        return $this->guest->get('certificates', array());
    }

    protected function requireOptions()
    {
        return $this->guest->get('products', array());
    }

}