<?php

namespace Parishop\ORMWrappers\AbacCondition;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   abacAttributeId
 * @property int                                                                   abacOperatorId
 * @property string                                                                name
 * @property string                                                                value
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $abacAttribute
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $abacOperator
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $abacRules
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $abacTargets
 * @method \Parishop\ORMWrappers\AbacAttribute\Entity abacAttribute()
 * @method \Parishop\ORMWrappers\AbacOperator\Entity abacOperator()
 * @method \Parishop\ORMWrappers\AbacRule\Entity[] abacRules()
 * @method \Parishop\ORMWrappers\AbacTarget\Entity[] abacTargets()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    /**
     * Текстовое представление условия
     * @return string
     */
    public function asString()
    {
        return $this->abacAttribute()->abacAttributeType()->name . '.'
               . $this->abacAttribute()->name
               . ' ' . $this->abacOperator()->name
               . ' ' . $this->name;
    }
}