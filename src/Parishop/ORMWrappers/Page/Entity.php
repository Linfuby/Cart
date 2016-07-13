<?php

namespace Parishop\ORMWrappers\Page;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property string                                                                alias
 * @property string                                                                short_description
 * @property string                                                                description
 * @property string                                                                model
 * @property int                                                                   sitemap
 * @property int                                                                   publish
 * @property int                                                                   ordering
 * @property string                                                                created
 * @property string                                                                modified
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
    /**
     * @return \Parishop\ORMWrappers\Keyword\Entity[]|\PHPixie\ORM\Loaders\Loader\Proxy\Caching
     */
    public function keywords()
    {
        return $this->builder->components()->orm()->keyword->where('model', $this->modelName())->where(
            'modelId', $this->id()
        )->find();
    }

    /**
     * @param array|string $url
     * @param array        $query
     * @param string       $resolverPath
     * @return \PHPixie\HTTP\Messages\URI|\Psr\Http\Message\UriInterface
     */
    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        if($this->alias === 'home') {
            return parent::url('', '', 'app.base');
        }

        return parent::url($this->alias, $query, $resolverPath);
    }
}
