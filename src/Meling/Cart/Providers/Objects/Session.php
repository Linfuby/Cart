<?php
namespace Meling\Cart\Providers\Objects;

class Session extends \Meling\Cart\Providers\Objects
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var \PHPixie\HTTP\Context\Session\SAPI
     */
    protected $provider;

    /**
     * Objects constructor.
     * @param \PHPixie\HTTP\Context\Session\SAPI $provider
     * @param string                             $key
     */
    public function __construct($provider, $key)
    {
        parent::__construct($provider);
        $this->key = $key;
    }

    /**
     * @param array $data
     * @return int
     */
    public function add($data = array())
    {
        $objects   = $this->objects();
        $objects[] = $data;
        $this->provider->set($this->key, $objects);

        return count($objects);
    }

    /**
     * @return array
     */
    public function clear()
    {
        $this->provider->set($this->key, array());

        return $this->objects();
    }

    /**
     * @return array
     */
    public function objects()
    {
        return $this->provider->get($this->key, array());
    }

    /**
     * @param int $id
     * @return array
     */
    public function remove($id)
    {
        $objects = $this->objects();
        unset($objects[$id]);
        $this->provider->set($this->key, $objects);

        return $this->objects();
    }

}
