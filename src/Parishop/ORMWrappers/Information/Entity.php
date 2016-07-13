<?php

namespace Parishop\ORMWrappers\Information;

/**
 * Class Entity
 * @property int    id
 * @property string name
 * @property string alias
 * @property string description
 * @property string meta_title
 * @property string meta_description
 * @property string meta_keywords
 * @property string og_title
 * @property string og_description
 * @property string og_image
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
