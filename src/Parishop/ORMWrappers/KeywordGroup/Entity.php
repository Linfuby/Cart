<?php
namespace Parishop\ORMWrappers\KeywordGroup;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 * @property string                                                                description
 * @property int                                                                   period
 * @property int                                                                   lvl
 * @property int                                                                   lft
 * @property int                                                                   rgt
 * @property int                                                                   yandexRegionId
 * @property int                                                                   season
 * @property string                                                                season_start
 * @property string                                                                season_end
 * @property int                                                                   commercial
 * @property string                                                                keywordCollectionId
 * @property int                                                                   plural
 * @property int                                                                   sexId
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $actions
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $articleCategories
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $articles
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $keywordCollection
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $pages
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $brands
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $questionCategories
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $questions
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $sex
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $shops
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $vacancies
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $yandexRegion
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $groups
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $synonyms
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $keywords
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable actions()
 * @method \Parishop\ORMWrappers\ArticleCategory\Entity[] articleCategories()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable articles()
 * @method \Parishop\ORMWrappers\KeywordCollection\Entity keywordCollection()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable pages()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable brands()
 * @method \Parishop\ORMWrappers\QuestionCategory\Entity[] questionCategories()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable questions()
 * @method \Parishop\ORMWrappers\Sex\Entity sex()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable shops()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable vacancies()
 * @method \Parishop\ORMWrappers\Region\Entity yandexRegion()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable groups()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable synonyms()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\EntitySemantic
{
    protected $nested;

    /**
     * @param                       $entity
     * @param \Parishop\App\Builder $builder
     */
    public function __construct($entity, $builder)
    {
        parent::__construct($entity, $builder);
        $this->nested = new \PHPixie\ORM\Extension\Nested($builder, $this);
    }

    public function allFrequency2($pageTypes)
    {
        $count = 0;
        foreach($pageTypes as $pageType) {
            foreach($this->{$pageType->relation}() as $page) {
                foreach($page->keywords() as $keyword) {
                    $count += (int)$keyword->frequency_2;
                }
            }
        }

        return $count;
    }

    public function collection()
    {
        return $this->keywordCollection() ? $this->keywordCollection()->name : '';
    }

    public function countKeywords($pageTypes)
    {
        /**
         * @var \Parishop\ORMWrappers\Page\Entity $page
         */
        $count = 0;
        foreach($pageTypes as $pageType) {
            foreach($this->{$pageType->relation}() as $page) {
                $count += count($page->keywords()->asArray());
            }
        }

        return $count;
    }

    public function countPages($pageTypes = array(), $modelName = null)
    {
        $count = 0;
        foreach($pageTypes as $pageType) {
            if(!$modelName || $modelName == $pageType->relation) {
                $count += count($this->{$pageType->relation}()->asArray());
            }
        }

        return $count;
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

    public function keywords()
    {
        static $keywords;
        if($keywords === null) {
            $keywords = $this->builder->components()->orm()->query('keyword');
            $keywords->where('yandexRegionId', $this->yandexRegionId);
            $keywords->where('sexId', $this->sexId);
            $keywords->where('plural', $this->plural);
            $keywords->where('season', $this->season);
            $keywords->where('commercial', $this->commercial);
            $keywords = $keywords->find(array('yandexRegion', 'sex'));
        }

        return $keywords;
    }

    /**
     * @return \PHPixie\ORM\Extension\Nested
     */
    public function nested()
    {
        return $this->nested;
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

    public function regionName()
    {
        return $this->yandexRegion() ? $this->yandexRegion()->name : '';
    }

    public function sexName()
    {
        return $this->sex() ? $this->sex()->name : '';
    }

    public function yandexRegionName()
    {
        return $this->yandexRegion() ? $this->yandexRegion()->name : '';
    }
}
