<?php
namespace Meling;

/**
 * Class Cart
 * @package Meling
 */
class Cart
{
    /** @var Cart\Providers\Provider */
    protected $provider;

    /**
     * Cart constructor.
     *
     * @param Cart\Providers\Provider $provider
     */
    public function __construct(Cart\Providers\Provider $provider)
    {
        $this->provider = $provider;
    }

}

