<?php

namespace Parishop\ORMWrappers\Vacancy;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   departmentId
 * @property int                                                                   cityId
 * @property string                                                                name
 * @property string                                                                description
 * @property string                                                                graph
 * @property string                                                                about_team
 * @property string                                                                important
 * @property string                                                                demands
 * @property string                                                                duties
 * @property string                                                                wages_from
 * @property string                                                                wages_to
 * @property int                                                                   publish
 * @property int                                                                   ordering
 * @property string                                                                created
 * @property string                                                                modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $city
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $department
 * @method \Parishop\ORMWrappers\City\Entity city()
 * @method \Parishop\ORMWrappers\Department\Entity department()
 ***********************************************************************************************************************
 * @property string                                                                meta_title
 * @property string                                                                meta_description
 * @property string                                                                meta_keywords
 * @property string                                                                og_title
 * @property string                                                                og_description
 * @property string                                                                og_image
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
    public function created()
    {
        $dt = new \DateTime($this->created);

        return $dt->format('d F Y');
    }

    public function keywords()
    {
        return $this->builder->components()->orm()->keyword->where('model', $this->modelName())->where(
            'modelId', $this->id()
        )->find();
    }

    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        return parent::url(
            array(
                'processor' => 'vacancies',
                'action'    => 'vacancy',
                'id'        => $this->id(),
            ), $query, $resolverPath
        );
    }

}
