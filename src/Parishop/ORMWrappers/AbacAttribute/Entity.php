<?php
namespace Parishop\ORMWrappers\AbacAttribute;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   abacAttributeTypeId
 * @property string                                                                name
 * @property string                                                                alias
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $abacAttributeType
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $abacConditions
 * @method \Parishop\ORMWrappers\AbacAttributeType\Entity abacAttributeType()
 * @method \Parishop\ORMWrappers\AbacCondition\Entity[] abacConditions()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

}