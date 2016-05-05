<?php
namespace Meling\Cart\Providers\Repository;

abstract class Session implements \Meling\Cart\Providers\Repository
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var \PHPixie\HTTP\Context
     */
    protected $httpContext;

    /**
     * Session constructor.
     * @param string                $key
     * @param \PHPixie\HTTP\Context $httpContext
     */
    public function __construct($key, \PHPixie\HTTP\Context $httpContext)
    {
        $this->key         = $key;
        $this->httpContext = $httpContext;
    }

    public function create($data = array())
    {
        $entity = array();
        foreach($this->columns() as $column) {
            if(!empty($data[$column])) {
                $entity[$column] = $data[$column];
            } else {
                $entity[$column] = null;
            }
        }

        return $entity;
    }

    protected function session()
    {
        return $this->httpContext->session();
    }

    /**
     * @return array
     */
    protected abstract function columns();

}