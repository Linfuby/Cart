<?php
namespace Parishop\ORMWrappers\AbacAlgorithm;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property string                                                                alias
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $abacPolicies
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $abacRules
 * @method \Parishop\ORMWrappers\AbacPolicy\Entity[] abacPolicies()
 * @method \Parishop\ORMWrappers\AbacRule\Entity[] abacRules()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}