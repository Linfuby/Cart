<?php
namespace Meling\Cart\Provider;

class Custom extends \Meling\Cart\Provider
{
    /**
     * @var \Meling\Cart\Provider
     */
    protected $provider;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var array
     */
    protected $certificates;

    /**
     * Order constructor.
     * @param \Meling\Cart\Provider $provider
     * @param array                 $options
     * @param array                 $certificates
     */
    public function __construct(\Meling\Cart\Provider $provider, array $options = array(), array $certificates = array())
    {
        $this->provider     = $provider;
        $this->options      = $options;
        $this->certificates = $certificates;
    }

    /**
     * @return int
     */
    public function rewards()
    {
        return $this->provider->rewards();
    }

    protected function requireCertificates()
    {
        return $this->certificates;
    }

    protected function requireOptions()
    {
        return $this->options;
    }

}
