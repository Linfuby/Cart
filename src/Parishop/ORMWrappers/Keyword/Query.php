<?php

namespace Parishop\ORMWrappers\Keyword;

/**
 * Class Query
 * @method Entity load($id, $preload = true)
 * @method Entity findOne($preload = array())
 * @package    ORMWrappers
 * @subpackage Query
 */
class Query extends \Parishop\ORMWrappers\Query
{
    public function preload($preload = array())
    {
        return array_merge($preload, array('keywordPositions', 'keywordFrequencies'));
    }

}
