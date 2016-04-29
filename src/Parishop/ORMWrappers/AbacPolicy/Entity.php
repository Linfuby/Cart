<?php

namespace Parishop\ORMWrappers\AbacPolicy;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   abacAlgorithmId
 * @property string                                                                name
 * @property string                                                                description
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $abacAlgorithm
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $abacRules
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $abacTargets
 * @method \Parishop\ORMWrappers\AbacAlgorithm\Entity abacAlgorithm()
 * @method \Parishop\ORMWrappers\AbacRule\Entity[] abacRules()
 * @method \Parishop\ORMWrappers\AbacTarget\Entity[] abacTargets()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}