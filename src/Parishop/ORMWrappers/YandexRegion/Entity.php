<?php

namespace Parishop\ORMWrappers\YandexRegion;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $keywordGroups
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $keywords
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $frequencies
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $positions
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $reports
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable keywordGroups()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable keywords()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable frequencies()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable positions()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable reports()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}
