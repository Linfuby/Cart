<?php

namespace Parishop\ORMWrappers\Keyword;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                model
 * @property int                                                                   modelId
 * @property string                                                                name
 * @property string                                                                positionYandex
 * @property int                                                                   positionYandexRegionId
 * @property string                                                                positionYandexCreated
 * @property string                                                                positionGoogle
 * @property int                                                                   frequency_0
 * @property int                                                                   frequency_1
 * @property int                                                                   frequency_2
 * @property string                                                                frequencyDate
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $keywordFrequencies
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $keywordPositions
 * @method \Parishop\ORMWrappers\KeywordFrequency\Entity[] keywordFrequencies()
 * @method \Parishop\ORMWrappers\KeywordPosition\Entity[]  keywordPositions()
 ***********************************************************************************************************************
 * @property int                                                                   keywordGroupId
 * @property int                                                                   yandexRegionId
 * @property int                                                                   sexId
 * @property int                                                                   plural
 * @property int                                                                   commercial
 * @property int                                                                   season
 * @property string                                                                season_start
 * @property string                                                                season_end
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $keywordGroup
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $yandexRegion
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $sex
 * @method \Parishop\ORMWrappers\KeywordGroup\Entity keywordGroup()
 * @method \Parishop\ORMWrappers\YandexRegion\Entity yandexRegion()
 * @method \Parishop\ORMWrappers\Sex\Entity sex()
 ***********************************************************************************************************************
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    public function createMany($relations, $positions)
    {
        /**
         * @var Query $query
         */
        $query  = $this->$relations->query();
        $entity = $this->builder->components()->orm()->createEntity($query->modelName());
        foreach($positions as $ps => $position) {
            $entity->setField($ps, $position['position']);
            $entity->setField($ps . 'RegionId', $position['regionId']);
            $entity->setField('created', $position['created']);
        }
        $entity->save();
        $this->$relations->add($entity);
    }

    public function gender()
    {
        return $this->sex() ? $this->sex()->name() : null;
    }

    public function grammatical()
    {
        if($this->plural == 1) {
            return 'Ед. число';
        }
        if($this->plural == 2) {
            return 'Мн. число';
        }
        if($this->plural == 3) {
            return 'Нет';
        }

        return ' - ';
    }

    public function plural()
    {
        if($this->plural == 1) {
            return 'Ед. число';
        }
        if($this->plural == 2) {
            return 'Мн. число';
        }

        return ' - ';
    }

    /**
     * @return null
     */
    public function position()
    {
        $yandex  = null;
        $created = '0000-00-00';
        foreach($this->keywordPositions() as $position) {
            if($position->created > $created) {
                $yandex = $position->yandex;
            }
        }

        return $yandex;
    }

    public function region()
    {
        return $this->yandexRegion() ? $this->yandexRegion()->name : '';
    }

    public function title()
    {
        $positions = $this->keywordPositions()->asArray();
        $position  = '0';
        if($positions) {
            $positions = end($positions);
            $dt        = new \DateTime($positions->created);
            $position  = $positions->yandex . ' (' . $dt->format('d.m.Y') . ')';
        }
        $frequency = $this->frequency_0 . ' / ' . $this->frequency_1 . ' / ' . $this->frequency_2;

        return $this->name . '<span class="uk-float-right">Yandex: ' . $position . '. Частотности: ' . $frequency . '</span>';
    }

    /**
     * @param \Parishop\ORMWrappers\Entity $report
     */
    public function updateFrequencyFromReport($report)
    {
        $date             = new \DateTime($report->getField('created'));
        $keywordFrequency = $this->builder->components()->orm()->query('keywordFrequency')
            ->where('keywordId', $this->id())
            ->where('yandexRegionId', $report->getField('yandexRegionId'))
            ->where('created', 'like', $date->format('Y-m') . '%')
            ->findOne();
        if(!$keywordFrequency) {
            $keywordFrequency = $this->builder->components()->orm()->createEntity('keywordFrequency');
            $keywordFrequency->setField('keywordId', $this->id());
            $keywordFrequency->setField('yandexRegionId', $report->getField('yandexRegionId'));
        }
        $frequency_0 = $report->getField('frequency_0');
        if($frequency_0 !== null) {
            $keywordFrequency->setField('frequency_0', $frequency_0);
            $this->setField('frequency_0', $frequency_0);
        }
        $frequency_1 = $report->getField('frequency_1');
        if($frequency_1 !== null) {
            $keywordFrequency->setField('frequency_1', $frequency_1);
            $this->setField('frequency_1', $frequency_1);
        }
        $frequency_2 = $report->getField('frequency_2');
        if($frequency_2 !== null) {
            $keywordFrequency->setField('frequency_2', $frequency_2);
            $this->setField('frequency_2', $frequency_2);
        }
        $keywordFrequency->setField('modified', date('Y-m-d H:i:s'));
        $keywordFrequency->save();
        $this->setField('frequency_date', date('Y-m-d'));
        $this->save();
    }
}
