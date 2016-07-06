<?php
namespace Parishop\ORMWrappers\PageType;

/**
 * Class Repository
 * @method Query query()
 * @method Entity create()
 * @package    ORMWrappers
 * @subpackage Repository
 */
class Repository extends \Parishop\ORMWrappers\Repository
{
    /**
     * @param string $modelName
     * @param string $name
     * @param string $sexId
     * @param int    $yandexRegionId
     * @param int    $plural
     * @param int    $season
     * @param int    $commercial
     * @return \Parishop\ORMWrappers\Entity
     */
    public function createPage($modelName, $name, $sexId, $yandexRegionId, $plural, $season, $commercial)
    {
        $entity = $this->builder->components()->orm()->repository($modelName)->create();
        $entity->setField('name', $name);
        $entity->setField('publish', 0);
        $entity->setField('keywordGroupId', 1);
        $entity->setField('sexId', $sexId);
        $entity->setField('yandexRegionId', $yandexRegionId);
        $entity->setField('plural', $plural);
        $entity->setField('season', $season);
        $entity->setField('commercial', $commercial);
        $entity->save();

        return $entity;
    }
}
