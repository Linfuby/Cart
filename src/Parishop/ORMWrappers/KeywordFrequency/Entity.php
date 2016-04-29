<?php
namespace Parishop\ORMWrappers\KeywordFrequency;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   keywordId
 * @property int                                                                   yandexRegionId
 * @property int                                                                   frequency_0
 * @property int                                                                   frequency_1
 * @property int                                                                   frequency_2
 * @property string                                                                created
 * @property string                                                                modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $keyword
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $yandexRegion
 * @method \Parishop\ORMWrappers\Keyword\Entity keyword()
 * @method \Parishop\ORMWrappers\YandexRegion\Entity yandexRegion()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

    public function yandexRegionName()
    {
        return $this->yandexRegion() ? $this->yandexRegion()->name : '';
    }
}
