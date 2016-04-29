<?php

namespace Parishop\ORMWrappers\AbacRule;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   abacAlgorithmId
 * @property int                                                                   effect
 * @property string                                                                name
 * @property string                                                                description
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $abacAlgorithm
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $abacPolicies
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $abacConditions
 * @method \Parishop\ORMWrappers\AbacAlgorithm\Entity abacAlgorithm()
 * @method \Parishop\ORMWrappers\AbacPolicy\Entity[] abacPolicies()
 * @method \Parishop\ORMWrappers\AbacCondition\Entity[] abacConditions()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}