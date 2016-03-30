<?php
namespace Meling\Cart\Provider;

class Custom extends \Meling\Cart\Provider
{
    /**
     * @var array
     */
    private $certificates;

    /**
     * @var array
     */
    private $options;

    /**
     * Order constructor.
     * @param array $options
     * @param array $certificates
     */
    public function __construct(array $options = array(), array $certificates = array())
    {
        $this->options      = $options;
        $this->certificates = $certificates;
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
