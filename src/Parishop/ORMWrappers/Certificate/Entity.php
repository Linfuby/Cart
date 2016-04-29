<?php

namespace Parishop\ORMWrappers\Certificate;

/**
 * Class Entity
 * @property int    id
 * @property string name
 * @property string description
 * @property int    price
 * @property string created
 * @property string modified
 * @property string meta_title
 * @property string meta_description
 * @property string meta_keywords
 * @property string og_title
 * @property string og_description
 * @property string og_image
 * @package Parishop\ORMWrappers\Certificate
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        return (string)parent::url(
            array(
                'processor' => 'certificates',
                'action'    => 'buy',
                'id'        => $this->id(),
            ), $query, $resolverPath
        );
    }
}
