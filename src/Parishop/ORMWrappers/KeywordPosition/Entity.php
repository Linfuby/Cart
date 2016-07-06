<?php
namespace Parishop\ORMWrappers\KeywordPosition;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   keywordId
 * @property int                                                                   yandexRegionId
 * @property int                                                                   yandex
 * @property string                                                                google
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

}
