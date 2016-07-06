<?php
namespace Parishop;

/**
 * Модели ORM
 * Class ORMWrappers
 * @package Parishop
 */
class ORMWrappers extends \PHPixie\ORM\Wrappers\Implementation
{
    /**
     * Строитель Бандла
     * @type \Parishop\App\Builder
     */
    protected $builder;

    /**
     * @type array
     */
    protected $databaseEntities     = array(
        'abacAlgorithm',
        'abacAttribute',
        'abacAttributeType',
        'abacCondition',
        'abacOperator',
        'abacPolicy',
        'abacRule',
        'abacTarget',
        'allAction',
        'allowAction',
        'allowProduct',
        'action',
        'actionProduct',
        'actionType',
        'address',
        'article',
        'articleCategory',
        'articleComment',
        'articleTag',
        'attribute',
        'attributeValue',
        'banner',
        'bannerImage',
        'brand',
        'call',
        'carousel',
        'carouselProduct',
        'cartOption',
        'cartCertificate',
        'category',
        'certificate',
        'city',
        'color',
        'contact',
        'country',
        'cronJob',
        'cronJobType',
        'customer',
        'customerCard',
        'customerClient',
        'customerGroup',
        'customerReward',
        'delivery',
        'department',
        'filter',
        'girth',
        'information',
        'keyword',
        'keywordCollection',
        'keywordFrequency',
        'keywordGroup',
        'keywordPosition',
        'line',
        'mainColor',
        'option',
        'order',
        'orderHistory',
        'orderCertificate',
        'orderOption',
        'orderStatus',
        'page',
        'pageType',
        'payment',
        'product',
        'productImage',
        'productImageView',
        'productPart',
        'productType',
        'region',
        'season',
        'sex',
        'question',
        'questionCategory',
        'shop',
        'restCertificate',
        'restOption',
        'shopTariffPayment',
        'shopTariff',
        'shopType',
        'size',
        'sizeRange',
        'subscriber',
        'tag',
        'user',
        'userDepartment',
        'userGroup',
        'vacancy',
        'vendor',
        'yandexRegion',
        'yandexReport',
        'yandexReportAlso',
        'yandexReportWith',
    );

    protected $databaseQueries      = array(
        'abacAlgorithm',
        'abacAttribute',
        'abacAttributeType',
        'abacCondition',
        'abacOperator',
        'abacPolicy',
        'abacRule',
        'abacTarget',
        'allAction',
        'allowAction',
        'allowProduct',
        'action',
        'actionProduct',
        'actionType',
        'address',
        'article',
        'articleCategory',
        'articleComment',
        'articleTag',
        'attribute',
        'attributeValue',
        'banner',
        'bannerImage',
        'brand',
        'call',
        'carousel',
        'carouselProduct',
        'cartOption',
        'cartCertificate',
        'category',
        'certificate',
        'city',
        'color',
        'contact',
        'country',
        'cronJob',
        'cronJobType',
        'customer',
        'customerCard',
        'customerClient',
        'customerGroup',
        'customerReward',
        'delivery',
        'department',
        'filter',
        'girth',
        'information',
        'keyword',
        'keywordCollection',
        'keywordFrequency',
        'keywordGroup',
        'keywordPosition',
        'line',
        'mainColor',
        'option',
        'order',
        'orderHistory',
        'orderCertificate',
        'orderOption',
        'orderStatus',
        'page',
        'pageType',
        'payment',
        'product',
        'productImage',
        'productImageView',
        'productPart',
        'productType',
        'region',
        'season',
        'sex',
        'question',
        'questionCategory',
        'shop',
        'restCertificate',
        'restOption',
        'shopTariffPayment',
        'shopTariff',
        'shopType',
        'size',
        'sizeRange',
        'subscriber',
        'tag',
        'user',
        'userDepartment',
        'userGroup',
        'vacancy',
        'vendor',
        'yandexRegion',
        'yandexReport',
        'yandexReportAlso',
        'yandexReportWith',
    );

    protected $databaseRepositories = array(
        'address',
        'attribute',
        'attributeValue',
        'call',
        'cartOption',
        'cartCertificate',
        'customer',
        'delivery',
        'option',
        'order',
        'pageType',
        'product',
        'productImage',
        'productImageView',
        'user',
    );

    protected $embeddedEntities     = array();

    /**
     * ORMWrappers constructor.
     * @param App\Builder $builder
     */
    public function __construct($builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Query $query
     * @return mixed
     */
    public function databaseQueryWrapper($query)
    {
        $class = __NAMESPACE__ . '\ORMWrappers\\' . ucfirst($query->modelName()) . '\Query';
        if(class_exists($class)) {
            return new $class($query, $this->builder);
        }

        return new ORMWrappers\Query($query, $this->builder);
    }

    /**
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Repository $repository
     * @return mixed
     */
    public function databaseRepositoryWrapper($repository)
    {
        $class = __NAMESPACE__ . '\ORMWrappers\\' . ucfirst($repository->modelName()) . '\Repository';
        if(class_exists($class)) {
            return new $class($repository, $this->builder);
        }

        return new ORMWrappers\Repository($repository, $this->builder);
    }

    /**
     * Переопределяем Объекты, чтобы передать в них Строителя
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $entity
     * @return mixed
     */
    protected function entityWrapper($entity)
    {
        $class = __NAMESPACE__ . '\ORMWrappers\\' . ucfirst($entity->modelName()) . '\Entity';
        if(class_exists($class)) {
            return new $class($entity, $this->builder);
        }

        return new ORMWrappers\Entity($entity, $this->builder);
    }

}
