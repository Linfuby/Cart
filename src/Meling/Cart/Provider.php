<?php
namespace Meling\Cart;

abstract class Provider
{
    /**
     * @var \Meling\Cart\Objects
     */
    protected $objects;

    public function objects()
    {
        if($this->objects === null) {
            $this->objects = $this->buildObjects();
        }

        return $this->objects;
    }

    protected function buildObjects()
    {
        return new \Meling\Cart\Objects($this->requireOptions(), $this->requireCertificates());
    }

    /**
     * @return int
     */
    public abstract function rewards();

    /**
     * @return array
     */
    protected abstract function requireCertificates();

    /**
     * @return array
     */
    protected abstract function requireOptions();

}
