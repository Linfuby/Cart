<?php
namespace Meling\Cart\Providers;

abstract class Objects
{
    protected $provider;

    /**
     * Objects constructor.
     * @param $provider
     */
    public function __construct($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param array $data
     * @return int
     */
    public abstract function add($data = array());

    /**
     * @return array
     */
    public abstract function clear();

    /**
     * @return array
     */
    public abstract function objects();

    /**
     * @param int $id
     * @return array
     */
    public abstract function remove($id);

}
