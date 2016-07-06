<?php

namespace Parishop\ORMWrappers\Action;

/**
 * Class Repository
 * @method Query query()
 * @package    ORMWrappers
 * @subpackage Repository
 */
class Repository extends \Parishop\ORMWrappers\RepositorySemantic
{
    protected $errorNotFound = 'Акция не найдена';

    public function add(
        $name,
        $actionTypeId,
        $description,
        $conditions,
        $using,
        $image,
        $date_start,
        $date_end,
        $week,
        $with_card,
        $price_flag,
        $discount,
        $count,
        $mode,
        $publish,
        $ordering,
        $meta_title,
        $meta_description,
        $meta_keywords,
        $og_title,
        $og_description,
        $og_image,
        $keywordGroupId,
        $yandexRegionId,
        $sexId,
        $plural,
        $season,
        $season_start,
        $season_end,
        $commercial,
        $userId)
    {
        $entity = $this->create();
        $entity->setField('name', $name);
        $entity->setField('actionTypeId', $actionTypeId);
        $entity->setField('description', $description);
        $entity->setField('conditions', $conditions);
        $entity->setField('using', $using);
        $entity->setField('image', $image);
        $entity->setField('date_start', $date_start);
        $entity->setField('date_end', $date_end);
        $entity->setField('week', $week);
        $entity->setField('with_card', $with_card);
        $entity->setField('price_flag', $price_flag);
        $entity->setField('discount', $discount);
        $entity->setField('count', $count);
        $entity->setField('mode', $mode);
        $entity->setField('publish', $publish);
        $entity->setField('ordering', $ordering);
        $entity->updateSemantic(
            $meta_title, $meta_description, $meta_keywords, $og_title, $og_description, $og_image, $keywordGroupId,
            $yandexRegionId, $sexId, $plural, $season, $season_start, $season_end, $commercial
        );
        $entity->setField('userId', $userId);
        $entity->save();
    }

    /**
     * @return Entity
     */
    public function create()
    {
        /**
         * @var Entity $entity
         */
        $entity = parent::create();
        $entity->setField('actionTypeId', 53000);

        return $entity;
    }
}
