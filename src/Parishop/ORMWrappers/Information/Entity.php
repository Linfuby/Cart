<?php

namespace Parishop\ORMWrappers\Information;

/**
 * Class Entity
 * @property int    id
 * @property string name
 * @property string alias
 * @property string description
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    /**
     * @param array|string $url
     * @param array        $query
     * @param string       $resolverPath
     * @return \PHPixie\HTTP\Messages\URI|\Psr\Http\Message\UriInterface
     */
    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        return parent::url('information/' . $this->alias . '.html', $query, $resolverPath);
    }

}
