<?php

namespace Parishop\ORMWrappers\Article;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   articleCategoryId
 * @property int                                                                   userId
 * @property int                                                                   modifiedUserId
 * @property string                                                                name
 * @property string                                                                alias
 * @property string                                                                short_description
 * @property string                                                                description
 * @property string                                                                image_thumb
 * @property string                                                                image
 * @property string                                                                product_text
 * @property int                                                                   hits
 * @property string                                                                publish_start
 * @property string                                                                publish_end
 * @property int                                                                   publish
 * @property int                                                                   ordering
 * @property string                                                                created
 * @property string                                                                modified
 ***********************************************************************************************************************
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $articleCategory
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $articleComments
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $products
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $tags
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $user
 * @method \Parishop\ORMWrappers\ArticleCategory\Entity articleCategory()
 * @method \Parishop\ORMWrappers\ArticleComment\Entity[] articleComments()
 * @method \Parishop\ORMWrappers\Product\Entity[] products()
 * @method \Parishop\ORMWrappers\ArticleTag\Entity[] articleTags()
 * @method \Parishop\ORMWrappers\User\Entity user()
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
    public function asides()
    {
        return $this->builder->components()->orm()->article->relatedTo(
            'articleCategory', $this->articleCategoryId
        )->notIn($this->id())->limit(5)->find()->asArray();
    }

    public function keywords()
    {
        return $this->builder->components()->orm()->keyword->where('model', $this->modelName())->where(
            'modelId', $this->id()
        )->find();
    }

    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        if($resolverPath === null) {
            $resolverPath = 'app.blog';
        }

        return parent::url(
            array(
                'processor' => 'articles',
                'action'    => 'article',
                'category'  => $this->articleCategory()->alias,
                'id'        => $this->alias,
            ), $query, $resolverPath
        );
    }

}
