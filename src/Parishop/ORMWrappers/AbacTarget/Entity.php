<?php

namespace Parishop\ORMWrappers\AbacTarget;

/**
 * Class Entity
 * @property int                                                        id
 * @property string                                                     name
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity $abacConditions
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity $abacPolicies
 * @method \Parishop\ORMWrappers\AbacCondition\Entity[] abacConditions()
 * @method \Parishop\ORMWrappers\AbacPolicy\Entity[] abacPolicies()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}